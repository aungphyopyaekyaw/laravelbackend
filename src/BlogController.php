<?php

namespace Agphyo\Backend;

use App\Blog;
use App\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostFormRequest;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $blog = Blog::where('author_id', $request->user()->id)->orderBy('created_at','desc')->paginate(5);
        return view('blog.index', compact('blog'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // if user can post i.e. user is admin or author
        if($request->user()->can_post()) {
          return view('blog.create');
        }
        else {
          return redirect('/')->withErrors('You have not sufficient permissions for writing post');
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $blog = new Blog();
        if($request->file('image')) {
          $image = $request->file('image');
          if($image->getMimeType() <> 'image/jpeg') {
              throw new \Exception("Only jpeg is allowed", 1);
          }
          $image->move(public_path() . '/blogpics/' . $request->user()->id, $image->getClientOriginalName());
          $blog->image = '/blogpics/' . $request->user()->id . '/' . $image->getClientOriginalName();
        }
        $blog->title = $request->get('title');
        $blog->body = $request->get('body');
        $blog->slug = str_slug($blog->title);
        $blog->author_id = $request->user()->id;
        if($request->has('save')) {
          $blog->active = 0;
          $message = 'Post saved successfully';
        }
        else {
          $blog->active = 1;
          $message = 'Post published successfully';
        }
        $blog->save();
        return redirect('b');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $blog = Blog::where('slug',$slug)->first();
        if(!$blog) {
          return redirect('/')->withErrors('requested page not found');
        }
        $comments = $blog->comments;
        return view('blog.show', compact('blog', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$slug)
    {
        $blog = Blog::where('slug',$slug)->first();
        if($blog && ($request->user()->id == $blog->author_id || $request->user()->is_admin()))
        return view('blog.edit', compact('blog'));
        return redirect('/')->withErrors('you have not sufficient permissions');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        $blog = new Blog();
        $post_id = $request->input('post_id');
        $blog = Blog::findOrFail($post_id);
        if($blog && ($blog->author_id == $request->user()->id || $request->user()->is_admin())) {
          $title = $request->input('title');
          $slug = str_slug($title);
          $duplicate = Blog::where('slug',$slug)->first();
          if($duplicate) {
            if($duplicate->id != $post_id) {
              return redirect('b/'.$blog->slug.'/edit')->withErrors('Title already exists.')->withInput();
            }
            else {
              $blog->slug = $slug;
            }
          }
          if($request->file('image')) {
              $image = $request->file('image');
              if($image->getMimeType() <> 'image/jpeg') {
                  throw new \Exception("Only jpeg is allowed", 1);
              }
              $image->move(public_path() . '/blogpics/' . $request->user()->id, $image->getClientOriginalName());
              $blog->image = '/blogpics/' . $request->user()->id . '/' . $image->getClientOriginalName();
          }

          $blog->title = $title;
          $blog->image = $blog->image;
          $blog->body = $request->input('body');
          if($request->has('save')) {
            $blog->active = 0;
            $message = 'Post saved successfully';
            $landing = $blog->slug.'/edit';
          }
          else {
            $blog->active = 1;
            $message = 'Post updated successfully';
            $landing = $blog->slug;
          }
          $blog->save();
          return redirect('b/'.$landing)->withErrors($message);
        }
        else {
          return redirect('/')->withErrors('you have not sufficient permissions');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);
        if($blog && ($blog->author_id == $request->user()->id || $request->user()->is_admin())) {
          $blog->delete();
          $data['message'] = 'Post deleted Successfully';
        } else {
          $data['errors'] = 'Invalid Operation. You have not sufficient permissions';
        }
        return redirect('b/')->with($data);
    }

}
