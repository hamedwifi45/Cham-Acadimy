<?php

namespace App\Livewire;

use App\Models\Comment;
use App\Models\Lesson;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LessonsComments extends Component
{
    public Lesson $lesson;

    public $body = '';

    public $parentId = null;

    public $comments;

    // متغيرات التعديل
    public $editingCommentId = null;

    public $editingReplyId = null;

    public $editBody = '';

    public function mount(Lesson $lesson)
    {
        $this->lesson = $lesson;
        $this->loadComments();
    }

    public function loadComments()
    {
        $this->comments = $this->lesson->comments()
            ->with('user', 'replies.user')
            ->whereNull('parent_id')
            ->latest()
            ->get();
    }

    public function addComment()
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }
        $this->validate([
            'body' => 'required|min:4|max:500',
        ]);
        $this->lesson->comments()->create([
            'user_id' => Auth::id(),
            'body' => $this->body,
            'lesson_id' => $this->lesson->id,
        ]);
        $this->body = '';
        $this->loadComments();
    }

    public function replyTo($commentId)
    {
        $this->parentId = $commentId;
        $this->body = '';
    }

    public function addReply()
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }
        $this->validate([
            'body' => 'required|min:4|max:500',
        ]);
        $this->lesson->comments()->create([
            'user_id' => Auth::id(),
            'body' => $this->body,
            'parent_id' => $this->parentId,
            'lesson_id' => $this->lesson->id,
        ]);
        $this->body = '';
        $this->loadComments();
        $this->parentId = null;
    }

    public function cancelReply()
    {
        $this->parentId = null;
        $this->body = '';
    }

    // === وظائف التعديل ===
    public function editComment($commentId)
    {
        $comment = Comment::findOrFail($commentId);
        if (Auth::id() == $comment->user_id || Auth::user()->is_admin) {
            $this->editingCommentId = $commentId;
            $this->editBody = $comment->body;
        }
    }

    public function updateComment()
    {
        $comment = Comment::findOrFail($this->editingCommentId);
        if (Auth::id() == $comment->user_id || Auth::user()->is_admin) {
            $this->validate([
                'editBody' => 'required|min:4|max:500',
            ]);
            $comment->update(['body' => $this->editBody]);
            $this->loadComments();
        }
        $this->cancelEdit();
    }

    public function editReply($replyId)
    {
        $reply = Comment::findOrFail($replyId);
        if (Auth::id() == $reply->user_id || Auth::user()->is_admin) {
            $this->editingReplyId = $replyId;
            $this->editBody = $reply->body;
        }
    }

    public function updateReply()
    {
        $reply = Comment::findOrFail($this->editingReplyId);
        if (Auth::id() == $reply->user_id || Auth::user()->is_admin) {
            $this->validate([
                'editBody' => 'required|min:4|max:500',
            ]);
            $reply->update(['body' => $this->editBody]);
            $this->loadComments();
        }
        $this->cancelEdit();
    }

    public function cancelEdit()
    {
        $this->editingCommentId = null;
        $this->editingReplyId = null;
        $this->editBody = '';
        $this->loadComments();
    }

    // === وظائف الحذف المباشرة ===
    public function deleteComment($commentId)
    {
        $comment = Comment::findOrFail($commentId);
        if (Auth::id() == $comment->user_id || Auth::user()->is_admin) {
            $comment->replies()->delete();
            $comment->delete();
            $this->loadComments();
        }
    }

    public function deleteReply($replyId)
    {
        $reply = Comment::findOrFail($replyId);
        if (Auth::id() == $reply->user_id || Auth::user()->is_admin) {
            $reply->delete();
            $this->loadComments();
        }
    }

    public function render()
    {
        return view('livewire.lessons-comments');
    }
}
