// Set the inactivity timeout (in milliseconds)
const INACTIVITY_TIMEOUT = 300000; // 5 minutes (5 * 60 * 1000)

let inactivityTimer;

function resetInactivityTimer() {
  clearTimeout(inactivityTimer);
  inactivityTimer = setTimeout(lockScreen, INACTIVITY_TIMEOUT);
}

function lockScreen() {
  window.location.href = '../auth/lockscreen.php';
}

// Reset the timer on user activity
document.addEventListener('mousemove', resetInactivityTimer);
document.addEventListener('keypress', resetInactivityTimer);
document.addEventListener('click', resetInactivityTimer);

// Start the timer when the page loads
resetInactivityTimer();