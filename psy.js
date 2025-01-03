// Add any interactive functionalities here

// Example: Display a random motivational quote
document.addEventListener("DOMContentLoaded", function() {
    const quotes = [
        "The only limit to our realization of tomorrow is our doubts of today. - Franklin D. Roosevelt",
        "Believe you can and you're halfway there. - Theodore Roosevelt",
        "It does not matter how slowly you go as long as you do not stop. - Confucius",
        "Your present circumstances don't determine where you can go; they merely determine where you start. - Nido Qubein"
    ];

    const randomQuote = quotes[Math.floor(Math.random() * quotes.length)];
    document.querySelector(".quotes").innerHTML = `<p>${randomQuote}</p>`;
});
