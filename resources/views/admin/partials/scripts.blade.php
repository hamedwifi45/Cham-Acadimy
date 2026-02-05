<script>
    document.getElementById('sidebarToggle').addEventListener('click', function() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('hidden');
    });

    document.addEventListener('click', function(event) {
        const sidebar = document.getElementById('sidebar');
        const toggleButton = document.getElementById('sidebarToggle');
        if (window.innerWidth < 768 && 
            !sidebar.contains(event.target) && 
            !toggleButton.contains(event.target) && 
            !sidebar.classList.contains('hidden')) {
            sidebar.classList.add('hidden');
        }
    });
</script>