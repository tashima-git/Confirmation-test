<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use Illuminate\Support\Facades\Response;

class DashboardController extends Controller
{
    /* =============================
       ダッシュボード表示
       - お問い合わせ一覧の検索・絞り込み・ページネーション
    ============================= */
    public function index(Request $request)
    {
        $query = Contact::query();

        // 名前／メールアドレス検索（完全一致→部分一致）
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;

            $query->where(function($q) use ($keyword) {
                $q->where('last_name', $keyword)
                  ->orWhere('first_name', $keyword)
                  ->orWhereRaw("CONCAT(last_name, first_name) = ?", [$keyword])
                  ->orWhere('email', $keyword);
            });

            // 完全一致でヒットしない場合は部分一致
            if (!$query->exists()) {
                $query = Contact::query()->where(function($q) use ($keyword) {
                    $q->where('last_name', 'like', "%{$keyword}%")
                      ->orWhere('first_name', 'like', "%{$keyword}%")
                      ->orWhereRaw("CONCAT(last_name, first_name) like ?", ["%{$keyword}%"])
                      ->orWhere('email', 'like', "%{$keyword}%");
                });
            }
        }

        // 性別フィルター
        if($request->filled('gender') && $request->gender !== 'all') {
            $query->where('gender', $request->gender);
        }

        // お問い合わせ種類フィルター
        if($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // 日付フィルター
        if($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        // ページネーション（検索条件を維持）
        $contacts = $query->paginate(7)->appends($request->except('page'));

        $categories = Category::all();

        return view('admin.dashboard', compact('contacts', 'categories'));
    }

    /* =============================
       CSVエクスポート
       - 現在の検索条件に応じてCSV生成
    ============================= */
    public function exportCsv(Request $request)
    {
        $query = Contact::query();

        // 名前／メールアドレス検索（部分一致）
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function($q) use ($keyword) {
                $q->where('last_name', 'like', "%{$keyword}%")
                  ->orWhere('first_name', 'like', "%{$keyword}%")
                  ->orWhereRaw("CONCAT(last_name, first_name) like ?", ["%{$keyword}%"])
                  ->orWhere('email', 'like', "%{$keyword}%");
            });
        }

        // 性別フィルター
        if($request->filled('gender') && $request->gender !== 'all') {
            $query->where('gender', $request->gender);
        }

        // お問い合わせ種類フィルター
        if($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // 日付フィルター
        if($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $contacts = $query->get();

        // CSVヘッダー
        $csvHeader = ['ID', 'お名前', '性別', 'メールアドレス', '電話番号', '住所', '建物名', 'お問い合わせ種類', 'お問い合わせ内容', '作成日'];

        // CSVデータ作成
        $csvData = [];
        foreach ($contacts as $contact) {
            $csvData[] = [
                $contact->id,
                $contact->last_name . ' ' . $contact->first_name,
                ['男性','女性','その他'][$contact->gender-1] ?? '',
                $contact->email,
                $contact->tel1 . '-' . $contact->tel2 . '-' . $contact->tel3,
                $contact->address,
                $contact->building,
                $contact->category->content ?? '',
                $contact->detail,
                $contact->created_at->format('Y-m-d H:i:s'),
            ];
        }

        // CSVストリーム出力
        $callback = function() use ($csvHeader, $csvData) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $csvHeader);
            foreach ($csvData as $row) {
                fputcsv($file, $row);
            }
            fclose($file);
        };

        $fileName = 'contacts_' . date('Ymd_His') . '.csv';
        return Response::stream($callback, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$fileName}",
        ]);
    }
}
