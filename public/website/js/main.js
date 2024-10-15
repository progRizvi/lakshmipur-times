/* date formatting start */
// Function to get Bengali day names, months in Gregorian, and Bengali calendar conversion
function getBengaliFormattedDate() {
    const banglaDays = [
        "রবিবার",
        "সোমবার",
        "মঙ্গলবার",
        "বুধবার",
        "বৃহস্পতিবার",
        "শুক্রবার",
        "শনিবার",
    ];
    const banglaMonths = [
        "জানুয়ারি",
        "ফেব্রুয়ারি",
        "মার্চ",
        "এপ্রিল",
        "মে",
        "জুন",
        "জুলাই",
        "আগস্ট",
        "সেপ্টেম্বর",
        "অক্টোবর",
        "নভেম্বর",
        "ডিসেম্বর",
    ];
    const banglaCalendarMonths = [
        "বৈশাখ",
        "জ্যৈষ্ঠ",
        "আষাঢ়",
        "শ্রাবণ",
        "ভাদ্র",
        "আশ্বিন",
        "কার্তিক",
        "অগ্রহায়ণ",
        "পৌষ",
        "মাঘ",
        "ফাল্গুন",
        "চৈত্র",
    ];

    // Get the current date in Dhaka timezone
    const options = {
        weekday: "long",
        year: "numeric",
        month: "long",
        day: "numeric",
        timeZone: "Asia/Dhaka",
        numberingSystem: "beng", // Bengali numbering system
    };

    const currentDate = new Date();
    const formatter = new Intl.DateTimeFormat("bn-BD", options);
    const formattedDate = formatter.format(currentDate);

    // Extract parts
    const dayOfWeek = banglaDays[currentDate.getDay()]; // Get the day of the week in Bengali
    const day = new Intl.NumberFormat("bn-BD").format(currentDate.getDate()); // Day in Bengali number
    const month = banglaMonths[currentDate.getMonth()]; // Month in Bengali
    const year = new Intl.NumberFormat("bn-BD").format(currentDate.getFullYear()); // Year in Bengali

    // Function to calculate Bengali date based on the Bengali calendar
    function getBengaliDate(gregorianDate) {
        const startYear = 593; // The offset for the Bengali calendar
        const banglaYear = gregorianDate.getFullYear() - startYear;

        const bengaliDate = {
            day: gregorianDate.getDate() - 15, // Approximation, needs to adjust for exact start of Bengali months
            month: banglaCalendarMonths[(gregorianDate.getMonth() + 6) % 12], // Offset the month by 6 for Bengali
            year: banglaYear,
        };

        if (bengaliDate.day <= 0) {
            bengaliDate.day += 30; // Adjust the day if it's less than 0
            bengaliDate.month =
                banglaCalendarMonths[(gregorianDate.getMonth() + 5) % 12]; // Move to the previous month
        }

        bengaliDate.day = new Intl.NumberFormat("bn-BD").format(bengaliDate.day); // Convert day to Bengali number
        bengaliDate.year = new Intl.NumberFormat("bn-BD").format(banglaYear); // Convert year to Bengali number

        return bengaliDate;
    }

    const banglaDate = getBengaliDate(currentDate);

    return `${dayOfWeek}, ${day} ${month} ${year}`;
    // return `${dayOfWeek}, ${day} ${month} ${year} ${banglaDate.day} ${banglaDate.month} ${banglaDate.year}`;
}

const banglaDate = document.getElementById("bangla_date");
banglaDate.style.color = "white";
banglaDate.innerHTML = getBengaliFormattedDate();
/* date formatting end */

// toggle menu start
const toggle_menu_btn = document.getElementById("toggle_menu_btn");
const toggle_menu_items = document.getElementById("toggle_menu_items");

// Toggle the menu when the button is clicked
toggle_menu_btn.addEventListener("click", (event) => {
    event.stopPropagation(); // Prevent this click from being caught by the document event
    toggle_menu_items.classList.toggle("hidden");
});

// Hide the menu when clicking outside of it
document.addEventListener("click", (event) => {
    const isClickInsideMenu = toggle_menu_items.contains(event.target);
    const isClickOnButton = toggle_menu_btn.contains(event.target);

    // If the click is not inside the menu or on the button, hide the menu
    if (!isClickInsideMenu && !isClickOnButton) {
        toggle_menu_items.classList.add("hidden");
    }
});
// toggle menu end

// toggle share items start
const toggle_share_btn = document.getElementById("toggle_share_btn");
const toggle_share_items = document.getElementById("toggle_share_items");

// Toggle the menu when the button is clicked
toggle_share_btn.addEventListener("click", (event) => {
    event.stopPropagation(); // Prevent this click from being caught by the document event
    toggle_share_items.classList.toggle("hidden");
});

// Hide the menu when clicking outside of it
document.addEventListener("click", (event) => {
    const isClickInsideMenu = toggle_share_items.contains(event.target);
    const isClickOnButton = toggle_share_btn.contains(event.target);

    // If the click is not inside the menu or on the button, hide the menu
    if (!isClickInsideMenu && !isClickOnButton) {
        toggle_share_items.classList.add("hidden");
    }
});
// toggle share items end

// print start
const handlePrint = () => {
    window.print();
};
// print end
