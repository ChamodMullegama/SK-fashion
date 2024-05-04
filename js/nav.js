function toggleSearch() {
    var searchDropdown = document.getElementById('searchDropdown');
    searchDropdown.classList.toggle('active');
}

function showLogoutConfirmation() {
    var confirmation = confirm("Are you sure you want to log out?");
    if (confirmation) {
        window.location.href = "./logout.php";
    } else {}
}