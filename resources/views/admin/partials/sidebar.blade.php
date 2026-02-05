<aside id="sidebar" class=" top-1 sidebar sticky bg-white shadow-md  z-20 w-64">
    <nav class="p-4">
        <ul class=" space-y-2">
            <li><a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 p-3 rounded-lg  {{ request()->is('admin') ? 'bg-indigo-50 text-indigo-700 font-medium' : 'hover:bg-gray-100 text-gray-700' }}"><i class="fas fa-home"></i><span>{{__("Display board")}}</span></a></li>
            <li><a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 p-3 rounded-lg {{ request()->is('admin/users*') ? 'bg-indigo-50 text-indigo-700 font-medium' : 'hover:bg-gray-100 text-gray-700' }}"><i class="fas fa-users"></i> <span>{{__("Users")}}</span></a></li>
            <li><a href="{{ route('admin.courses.index') }}" class="flex items-center gap-3 p-3 rounded-lg {{ request()->is('admin/courses*') ? 'bg-indigo-50 text-indigo-700 font-medium' : 'hover:bg-gray-100 text-gray-700' }}"><i class="fas fa-book"></i> <span>{{__("Courses")}}</span></a></li>
            <li><a href="{{ route('admin.lessons.index') }}" class="flex items-center gap-3 p-3 rounded-lg {{ request()->is('admin/lessons*') ? 'bg-indigo-50 text-indigo-700 font-medium' : 'hover:bg-gray-100 text-gray-700' }}"><i class="fas fa-video"></i> <span>{{ __("Lessonss") }}</span></a></li>
            <li><a href="{{ route('admin.posts.index') }}" class="flex items-center gap-3 p-3 rounded-lg {{ request()->is('admin/posts*') ? 'bg-indigo-50 text-indigo-700 font-medium' : 'hover:bg-gray-100 text-gray-700' }}"><i class="fas fa-file-alt"></i> <span>{{ __('Blog') }}</span></a></li>
            <li><a href="{{ route('admin.authers.index') }}" class="flex items-center gap-3 p-3 rounded-lg {{ request()->is('admin/authers*') ? 'bg-indigo-50 text-indigo-700 font-medium' : 'hover:bg-gray-100 text-gray-700' }}"><i class="fas  fa-chalkboard-teacher"></i> <span>{{__('Author')}}</span></a></li>
            <li><a href="{{ route('admin.puraches.index') }}" class="flex items-center gap-3 p-3 rounded-lg {{ request()->is('admin/puraches*') ? 'bg-indigo-50 text-indigo-700 font-medium' : 'hover:bg-gray-100 text-gray-700' }}"><i class="fas fa-shopping-cart"></i> <span>{{ __('Sales')}}</span></a></li>
        </ul>
    </nav>
</aside>