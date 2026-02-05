<div>
    <div class="lesson-card p-6">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-xl font-bold text-gray-800">
                {{ __('Comments') }} ({{ $comments->count() + $comments->sum('replies_count') }})
            </h3>
            @auth
            <button 
                wire:click="$set('parentId', null)"
                class="text-sm bg-indigo-600 text-white px-3 py-1 rounded-lg hover:bg-indigo-700 transition">
                <i class="fas fa-plus mr-1"></i>{{ __('Add Comment') }}
            </button>
            @endauth
        </div>

        @auth
        @if($parentId === null || $parentId)
        <div class="mb-6 p-4 bg-gray-50 rounded-lg border-l-4 border-indigo-500">
            <form wire:submit.prevent="{{ $parentId ? 'addReply' : 'addComment' }}">
                <div class="mb-3">
                    @if($parentId)
                        <div class="text-sm text-indigo-700 mb-2 font-medium">
                            <i class="fas fa-reply mr-1"></i>{{ __('Replying to a comment') }}
                        </div>
                    @endif
                    <textarea 
                        wire:model="body"
                        rows="3" 
                        placeholder="{{ $parentId ? __('Write your reply...') : __('Write your comment or ask a question...') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent
                               @error('body') border-red-500 @enderror"
                    ></textarea>
                    @error('body')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex justify-end gap-2">
                    @if($parentId)
                        <button 
                            type="button"
                            wire:click="cancelReply"
                            class="px-4 py-2 text-gray-600 hover:text-gray-800">
                            {{ __('Cancel') }}
                        </button>
                    @endif
                    <button 
                        type="submit"
                        wire:loading.attr="disabled"
                        class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition
                               disabled:opacity-50">
                        {{ $parentId ? __('Post Reply') : __('Post Comment') }}
                    </button>
                </div>
            </form>
        </div>
        @endif
        @endauth

        <div class="space-y-6">
            @foreach ($comments as $comment)
                <div class="flex gap-4 p-4 bg-white rounded-xl border border-gray-200 shadow-sm">
                    <div class="w-10 h-10 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-sm">
                        <img 
                            src="{{ $comment->user->profile_photo_path ? asset('storage/' . $comment->user->profile_photo_path) : $comment->user->profile_photo_url }}" 
                            alt="{{ $comment->user->name }}" 
                            class="w-10 h-10 rounded-full object-cover"
                        >    
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="font-semibold text-gray-800">{{ $comment->user->name }}</span>
                            <span class="text-gray-500 text-sm">{{ $comment->created_at->diffForHumans() }}</span>
                            
                            @auth
                                @if(auth()->id() == $comment->user_id || auth()->user()->is_admin())
                                    <div class="flex gap-2 ml-2">
                                        <button 
                                            wire:click="editComment({{ $comment->id }})"
                                            class="text-blue-600 hover:text-blue-800 text-xs">
                                            <i class="fas fa-edit"></i> {{ __('Edit') }}
                                        </button>  
                                        <button 
                                            wire:click="deleteComment({{ $comment->id }})"
                                            wire:confirm="{{ __('Are you sure you want to delete this comment?') }}"
                                            class="text-red-600 hover:text-red-800 text-xs">
                                            <i class="fas fa-trash"></i> {{ __('Delete') }}
                                        </button>
                                    </div>
                                @endif
                            @endauth
                        </div>
                        
                        @if($editingCommentId == $comment->id)
                            <form wire:submit.prevent="updateComment" class="mb-3">
                                <textarea 
                                    wire:model="editBody"
                                    rows="3" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                ></textarea>
                                <div class="flex gap-2 mt-2">
                                    <button 
                                        type="submit"
                                        class="text-sm bg-indigo-600 text-white px-3 py-1 rounded hover:bg-indigo-700">
                                        {{ __('Save') }}
                                    </button>
                                    <button 
                                        type="button"
                                        wire:click="cancelEdit"
                                        class="text-sm bg-gray-300 text-gray-700 px-3 py-1 rounded hover:bg-gray-400">
                                        {{ __('Cancel') }}
                                    </button>
                                </div>
                            </form>
                        @else
                            <p class="text-gray-600 mb-3">{{ $comment->body }}</p>
                        @endif
                        
                        <div class="flex items-center gap-4">
                            @auth
                            <button 
                                wire:click="replyTo({{ $comment->id }})"
                                class="text-indigo-600 hover:text-indigo-800 flex items-center gap-1 text-sm font-medium">
                                <i class="fas fa-reply"></i> {{ __('Reply') }}
                            </button>
                            @endauth
                        </div>
                    </div>
                </div>

                @if($comment->replies->count() > 0)
                    <div class="ml-14 space-y-4 -mt-2">
                        @foreach($comment->replies as $reply)
                        <div class="flex gap-4 p-3 bg-blue-50 rounded-lg border border-blue-200">
                            <div class="w-8 h-8 bg-indigo-600 rounded-full flex items-center justify-center text-white font-bold text-xs">
                                <img 
                                    src="{{ $reply->user->profile_photo_path ? asset('storage/' . $reply->user->profile_photo_path) : $reply->user->profile_photo_url }}" 
                                    alt="{{ $reply->user->name }}" 
                                    class="w-8 h-8 rounded-full object-cover"
                                >
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="font-semibold text-indigo-800 text-sm">{{ $reply->user->name }}</span>
                                    <span class="text-gray-500 text-xs">{{ $reply->created_at->diffForHumans() }}</span>
                                    <span class="bg-blue-100 text-blue-800 text-xs px-2 py-0.5 rounded-full font-medium">
                                        {{ __('Reply') }}
                                    </span>
                                    
                                    @auth
                                        @if(auth()->id() == $reply->user_id || auth()->user()->is_admin())
                                            <div class="flex gap-2 ml-2">
                                                <button 
                                                    wire:click="editReply({{ $reply->id }})"
                                                    class="text-blue-600 hover:text-blue-800 text-xs">
                                                    <i class="fas fa-edit"></i> {{ __('Edit') }}
                                                </button>
                                                <button wire:click="deleteReply({{ $reply->id }})" wire:confirm="{{ __('Are you sure you want to delete this reply?') }}"
                                                    class="text-red-600 hover:text-red-800 text-xs">
                                                    <i class="fas fa-trash"></i> {{ __('Delete') }}
                                                </button>
                                            </div>
                                        @endif
                                    @endauth
                                </div>
                                
                                @if($editingReplyId == $reply->id)
                                    <form wire:submit.prevent="updateReply" class="mb-2">
                                        <textarea 
                                            wire:model="editBody"
                                            rows="2" 
                                            class="w-full px-2 py-1 border border-gray-300 rounded text-sm focus:ring-1 focus:ring-indigo-500 focus:border-transparent"
                                        ></textarea>
                                        <div class="flex gap-1 mt-1">
                                            <button 
                                                type="submit"
                                                class="text-xs bg-indigo-600 text-white px-2 py-1 rounded hover:bg-indigo-700">
                                                {{ __('Save') }}
                                            </button>
                                            <button 
                                                type="button"
                                                wire:click="cancelEdit"
                                                class="text-xs bg-gray-300 text-gray-700 px-2 py-1 rounded hover:bg-gray-400">
                                                {{ __('Cancel') }}
                                            </button>
                                        </div>
                                    </form>
                                @else
                                    <p class="text-gray-700 text-sm">{{ $reply->body }}</p>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif
            @endforeach

            @if($comments->count() == 0)
                <div class="text-center py-8 text-gray-500">
                    {{ __('No comments yet. Be the first to comment!') }}
                </div>
            @endif
        </div>

        
    </div>
</div>