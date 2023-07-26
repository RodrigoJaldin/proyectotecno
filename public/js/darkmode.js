    // Function to switch to night mode
    function enableNightMode() {
        document.body.classList.add("night-mode");
    }

    // Function to switch to day mode
    function disableNightMode() {
        document.body.classList.remove("night-mode");
    }

    // Function to check if it's night time (assumes night time between 7 PM and 6 AM)
    function isNightTime() {
        const now = new Date();
        const hour = now.getHours();
        return hour >= 19 || hour < 6;
    }

    // Function to toggle night mode based on the current time
    function toggleNightMode() {
        if (isNightTime()) {
            enableNightMode();
        } else {
            disableNightMode();
        }
    }

    // Check night mode on page load
    toggleNightMode();

    // Check night mode every minute
    setInterval(toggleNightMode, 60000);
