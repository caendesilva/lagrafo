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
    }
    function openSidebar() {
        sidebarOpen = true;
        sidebar.classList.add('active');
        sidebarToggleButton.classList.add('active');
    }
    sidebarOpen ? closeSidebar() : openSidebar();
}
// On click of sidebar toggle button
sidebarToggleButton.addEventListener('click', function () {
    toggleSidebar();
});
//# sourceMappingURL=lagrafo.js.map