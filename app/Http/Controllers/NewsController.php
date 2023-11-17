<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = News::all();
        
        if(!empty($news)) {
            $response = [
                'message' => 'Menampilkan Data Berita',
                'data' => $news
            ];
            return response()->json($response, 200);
        } else {
            $response = [
                'message' => 'Data Tidak ada'
            ];
            return response()->json($response,200);
        }
    }

  
    public function store(Request $request)
    {
        // $input =  $request->validate([
        //     'title' => 'required',
        //     'author' => 'required',
        //     'description' => 'required',
        //     'content' => 'required',
        //     'url' => 'required',
        //     'url_image' => 'required',
        //     'published_at' => 'nullable',
        //     'category' => 'required'
        // ]);

        $input = [
            "title" => $request->title,
            "author" => $request->author,
            "description" => $request->description,
            "content" => $request->content,
            "url" => $request->url,
            "url_image" => $request->url_image,
            "category" => $request->category
        ];

       $news = News::create($input);

       $response = [
           'message' => 'Data Berita Berhasil Dibuat',
           'data' => $news,
       ];

       return response()->json($response, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $news = News::find($id);

        if ($news) {
            $response = [
                'message' => 'Get Detail News',
                'data' => $news
            ];

            return response()->json($response,200);
        } else {
            $response = [
                'message' => 'Data Tidak ada'
            ];

            return response()->json($response, 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
   
    public function update(Request $request, string $id)
    {
        $news = News::find($id);
        if ($news) {
            $response = [
                'message' => ' News is updated',
				'data' => $news->update($request->all())
            ];

            return response()->json($response, 200);
		} else {
			$response = [
				'message' => 'Data not found'
			];

			return response()->json($response, 404);
         }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $news = News::find($id);

		if ($news) {
			$response = [
				'message' => 'Data Berita Berhasil dihapus',
				'data' => $news->delete()
			];

			return response()->json($response, 200); 
		} else {
			$response = [
				'message' => 'Data not found'
			];

			return response()->json($response, 404);
		}
    }

    //pencarian berita berdasarkan title 
    public function search(Request $request, $title)
    {
        $databaru = News::where('title', 'like', '%' . $title . '%')->get();
        if ($databaru->isEmpty()) {
            $data = [
                'message' => 'News not found'
            ];

            return response()->json($data, 404);
        }
        $data = [
            'message' => 'Get Searched News',
            'data' => $databaru
        ];

        return response()->json($data, 200);
    }

    // pencarian berita category Sport
    public function sport()
    {
        $databaru = News::where('category', 'sport')->get();
        if ($databaru->isEmpty()) {
            $data = [
                'message' => 'News not found'
            ];

            return response()->json($data, 404);
        }
        $data = [
            'message' => 'Get Sport News',
            'total' => $databaru->count(),
            'data' => $databaru
        ];

        return response()->json($data, 200);
    }

    // Method Pencarian Category Finance
    public function finance()
    {
        $databaru = News::where('category', 'finance')->get();
        if ($databaru->isEmpty()) {
            $data = [
                'message' => 'News not found'
            ];

            return response()->json($data, 404);
        }
        $data = [
            'message' => 'Get Finance News',
            'total' => $databaru->count(),
            'data' => $databaru
        ];

        return response()->json($data, 200);
    }

    // Method Pencarian Category Autmotive
    public function automotive()
    {
        $databaru = News::where('category', 'automotive')->get();
        if ($databaru->isEmpty()) {
            $data = [
                'message' => 'News not found'
            ];

            return response()->json($data, 404);
        }
        $data = [
            'message' => 'Get Automotive News',
            'total' => $databaru->count(),
            'data' => $databaru
        ];

        return response()->json($data, 200);
    }
}
