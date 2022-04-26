/**
 * Lagrafo Frontend Scripts
 * @version dev-master
 */
var sidebarOpen = false;
var sidebarToggleButton = document.getElementById('sidebar-toggle');
var sidebar = document.getElementById('sidebar');
function toggleSidebar() {
    function closeSidebar() {
        sidebarOpen = false;
        sidebar.classList.remove('active');
        sidebarToggleButton.classList.remove('active');
        // Remove the backdrop
        var backdrop = document.getElementById('sidebar-backdrop');
        backdrop.parentNode.removeChild(backdrop);
    }
    function openSidebar() {
        sidebarOpen = true;
        sidebar.classList.add('active');
        sidebarToggleButton.classList.add('active');
        // Add backdrop
        var backdrop = document.createElement('div');
        backdrop.id = 'sidebar-backdrop';
        backdrop.title = 'Click to close sidebar';
        backdrop.classList.add('backdrop');
        backdrop.addEventListener('click', closeSidebar);
        document.body.appendChild(backdrop);
    }
    sidebarOpen ? closeSidebar() : openSidebar();
}
// On click of sidebar toggle button
sidebarToggleButton.addEventListener('click', function () {
    toggleSidebar();
});
// If sidebar is open, close it on escape key press
document.addEventListener('keydown', function (e) {
    if (sidebarOpen && e.key === 'Escape') {
        toggleSidebar();
    }
});
//# sourceMappingURL=lagrafo.js.map