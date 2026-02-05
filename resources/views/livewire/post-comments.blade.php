<div class="mt-12">
    <!-- عنوان مع عدد التعليقات -->
    <h3 class="font-bold text-gray-800 text-xl mb-6">
        {{ __('Comments') }} ({{ $comments->count() }})
    </h3>
    
    <div class="space-y-6">
        @forelse ($comments as $comment)
            <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                <div class="flex gap-4">
                    <div class="w-10 h-10 flex-shrink-0">
                        <img 
                            src="{{ $comment->user->profile_photo_path ? asset('storage/' . $comment->user->profile_photo_path) : $comment->user->profile_photo_url }}" 
                            alt="{{ $comment->user->name }}" 
                            class="w-10 h-10 rounded-full object-cover border-2 border-white shadow-sm"
                        >
                    </div>

                    <div class="flex-1 min-w-0">
                        @if($editingCommentId == $comment->id)
                            <!-- نموذج التعديل -->
                            <div class="mb-3">
                                <textarea 
                                    wire:model="editingCommentText"
                                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                    rows="3"
                                    placeholder="{{ __('Edit your comment...') }}"
                                ></textarea>
                                @error('editingCommentText') 
                                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span> 
                                @enderror
                            </div>
                            <div class="flex gap-2">
                                <button 
                                    wire:click="update"
                                    wire:loading.attr="disabled"
                                    class="px-3 py-1.5 bg-indigo-600 text-white text-sm rounded-lg hover:bg-indigo-700 transition text-sm font-medium">
                                    {{ __('Save') }}
                                </button>
                                <button 
                                    wire:click="cancelEdit"
                                    class="px-3 py-1.5 bg-gray-300 text-gray-700 text-sm rounded-lg hover:bg-gray-400 transition text-sm font-medium">
                                    {{ __('Cancel') }}
                                </button>
                            </div>
                        @else
                            <!-- عرض التعليق العادي -->
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center gap-2">
                                    <span class="font-semibold text-gray-800">{{ $comment->user->name }}</span>
                                    <span class="text-gray-500 text-sm">{{ $comment->created_at->diffForHumans() }}</span>
                                </div>

                                @if(auth()->check() && (auth()->user()->is_admin() || $comment->user_id === auth()->id()))
                                    <div class="flex gap-2">
                                        <!-- زر التعديل -->
                                        <button 
                                            wire:click="edit({{ $comment->id }})"
                                            class="text-indigo-600 hover:text-indigo-800 p-1.5 rounded-full hover:bg-indigo-50 transition"
                                            title="{{ __('Edit') }}">
                                            <i class="fas fa-edit text-xs"></i>
                                        </button>

                                        <!-- زر الحذف -->
                                        <button 
                                            wire:click="delete({{ $comment->id }})"
                                            onclick="return confirm('{{ __('Are you sure you want to delete this comment?') }}')"
                                            class="text-red-600 hover:text-red-800 p-1.5 rounded-full hover:bg-red-50 transition"
                                            title="{{ __('Delete') }}">
                                            <i class="fas fa-trash-alt text-xs"></i>
                                        </button>
                                    </div>
                                @endif
                            </div>
                            <p class="text-gray-600 whitespace-pre-line">{{ $comment->comment }}</p>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-8 text-gray-500">
                {{ __('No comments yet. Be the first to comment!') }}
            </div>
        @endforelse
    </div>
    
    @auth
    <div class="mt-8 bg-white rounded-xl p-6 shadow-sm border border-gray-100">
        <h4 class="font-bold text-gray-800 mb-4">{{ __('Add your comment') }}</h4>
        <form wire:submit.prevent="addComment">
            <div class="mb-4">
                <textarea 
                    wire:model="comment"
                    rows="4" 
                    placeholder="{{ __('Write your comment here...') }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent
                           @error('comment') border-red-500 @enderror"
                ></textarea>
                @error('comment')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>
            <button 
                type="submit"
                wire:loading.attr="disabled"
                class="bg-indigo-600 text-white px-6 py-2.5 rounded-lg hover:bg-indigo-700 transition
                       disabled:opacity-50 disabled:cursor-not-allowed font-medium"
            >
                <span wire:loading.remove>{{ __('Post Comment') }}</span>
                <span wire:loading class="flex items-center">
                    <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    {{ __('Posting...') }}
                </span>
            </button>
        </form>
    </div>
    @else
        <div class="mt-8 text-center py-6 bg-gray-50 rounded-xl">
            <p class="text-gray-600 mb-4">{{ __('You must be logged in to comment.') }}</p>
            <a href="{{ route('login') }}" class="inline-block bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition font-medium">
                {{ __('Login to comment') }}
            </a>
        </div>
    @endauth
</div>