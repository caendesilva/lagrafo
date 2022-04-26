/**
 * Lagrafo Frontend Scripts
 * @version dev-master
 */
var sidebarOpen = false;
var sidebarToggleButton = document.getElementById('sidebar-toggle');
var sidebar = document.getElementById('sidebar');
var backdrop = document.createElement('div');
function toggleSidebar() {
    sidebarOpen ? closeSidebar() : openSidebar();
    function openSidebar() {
        sidebarOpen = true;
        sidebar.classList.add('active');
        sidebarToggleButton.classList.add('active');
        createBackdropElement();
    }
    function closeSidebar() {
        sidebarOpen = false;
        sidebar.classList.remove('active');
        sidebarToggleButton.classList.remove('active');
        removeBackdropElement();
    }
    function createBackdropElement() {
        backdrop.id = 'sidebar-backdrop';
        backdrop.title = 'Click to close sidebar';
        backdrop.classList.add('backdrop');
        backdrop.classList.add('active');
        backdrop.addEventListener('click', closeSidebar);
        document.body.appendChild(backdrop);
        document.getElementById('content').classList.add('sidebar-active');
        document.body.style.background = 'black';
    }
    function removeBackdropElement() {
        if (backdrop.parentNode) {
            backdrop.parentNode.removeChild(backdrop);
        }
        document.getElementById('content').classList.remove('sidebar-active');
        document.body.style.background = '';
    }
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