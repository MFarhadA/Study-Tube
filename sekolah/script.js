
    document.getElementById('toggleSidebar').addEventListener('click', function() {
        document.getElementById('sidebar').classList.toggle('collapsed-sidebar');
        document.getElementById('mainContent').classList.toggle('collapsed-content');
    });