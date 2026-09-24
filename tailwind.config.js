/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/views/**/*.php",
    "./resources/js/**/*.js",
    "./public/**/*.html",
    "./app/**/*.php"
  ],
  theme: {
    extend: {
      colors: {
        navy: {
          950: "#2A67B2",
          900: "#2A67B2",
          800: "#225795",
          700: "#3573BE",
          600: "#2A67B2",
          500: "#4F8BD0",
        },
        gold: {
          600: "#9A6F00",
          500: "#FFC632",
          400: "#FFC632",
          300: "#FFD766",
          200: "#FFE9A8",
        },
        ink: {
          900: "#0f1521",
          700: "#374151",
          500: "#6b7280",
          300: "#d1d5db",
          100: "#f3f4f6",
        },
      },
      fontFamily: {
        sans: ["Inter", "ui-sans-serif", "system-ui", "-apple-system", "sans-serif"],
      },
      maxWidth: {
        container: "80rem",
      },
      boxShadow: {
        premium: "0 20px 60px -15px rgba(42, 103, 178, 0.35)",
        card: "0 1px 2px rgba(15, 23, 42, 0.04), 0 8px 24px -8px rgba(15, 23, 42, 0.08)",
        "card-hover": "0 1px 2px rgba(15, 23, 42, 0.06), 0 24px 48px -16px rgba(15, 23, 42, 0.18)",
        glow: "0 0 0 1px rgba(255, 198, 50, 0.25), 0 16px 40px -12px rgba(255, 198, 50, 0.5)",
      },
      transitionTimingFunction: {
        premium: "cubic-bezier(0.16, 1, 0.3, 1)",
      },
    },
  },
  plugins: [],
};
