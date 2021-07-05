<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Comment;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $id = $request->id ?? 1; // assume post id 1

        $comments = Comment::with(['replies.replies'])
                            ->where('post_id', $id)
                            ->where('parent_id', null)
                            ->get();

        // build response data
        // assume the post content
        $faker = \Faker\Factory::create();

        $data = [
            'success' => true,
            'data'    => [
                'id'        => 1,
                'title'     => 'The Most Amazing Blog Post!',
                'author'    => $faker->name,
                'body'      => $faker->paragraph($nbSentences = 10, $variableNbSentences = true),
                'comments'  => $comments
            ]
        ];

        return response()->json($data);
    }
}
