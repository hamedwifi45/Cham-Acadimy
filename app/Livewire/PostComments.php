<?php

namespace App\Livewire;

use App\Models\CommentPost;
use App\Models\Post;
use Livewire\Component;

class PostComments extends Component
{
    public Post $post;

    public $comment = '';

    public $comments;

    public $editingCommentId = null;

    public $editingCommentText = '';

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->loadComments();
    }

    public function loadComments()
    {
        $this->comments = $this->post->comments()->with('user')->latest()->get();
    }

    public function addComment()
    {
        if (! auth()->check()) {
            return redirect()->route('login');
        }

        $this->validate([
            'comment' => 'required|string|min:4|max:500',
        ]);

        CommentPost::create([
            'post_id' => $this->post->id,
            'user_id' => auth()->id(),
            'comment' => $this->comment,
        ]);

        $this->loadComments();
        $this->comment = '';
        $this->dispatch('commentAdded');
    }

    public function edit($commentId)
    {
        $comment = CommentPost::find($commentId);

        if ($comment && (auth()->user()->is_admin() || $comment->user_id === auth()->id())) {
            $this->editingCommentId = $commentId;
            $this->editingCommentText = $comment->comment;
        }
    }

    public function update()
    {
        $comment = CommentPost::find($this->editingCommentId);

        if ($comment && (auth()->user()->is_admin() || $comment->user_id === auth()->id())) {
            $this->validate([
                'editingCommentText' => 'required|string|min:4|max:500',
            ]);

            $comment->update(['comment' => $this->editingCommentText]);

            $this->cancelEdit();
            $this->loadComments();
            session()->flash('success', __('Comment updated successfully.'));
        }
    }

    public function cancelEdit()
    {
        $this->editingCommentId = null;
        $this->editingCommentText = '';
    }

    public function delete($commentId)
    {
        $comment = CommentPost::find($commentId);

        if ($comment && (auth()->user()->is_admin || $comment->user_id === auth()->id())) {
            $comment->delete();
            $this->loadComments();
            session()->flash('success', __('Comment deleted successfully.'));
        }
    }

    public function render()
    {
        return view('livewire.post-comments');
    }
}
