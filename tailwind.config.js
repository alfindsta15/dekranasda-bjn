// tailwind.config.js
module.exports = {
  content: [
    "./resources/views/**/*.blade.php",
    "./resources/js/**/*.js",
    "./resources/**/*.vue",
    "./app/View/Components/**/*.php",
    "./routes/**/*.php",
  ],
  theme: {
    extend: {
      colors: {
        brand: {
          sky50:  "#f0f9ff",
          sky100: "#e0f2fe",
          sky200: "#bae6fd",
          sky600: "#0284c7",
          sky700: "#0369a1",
        },
      },
      boxShadow: {
        sky: "0 10px 20px -10px rgba(2,132,199,0.25)",
      },
    },
  },
  plugins: [],
};
