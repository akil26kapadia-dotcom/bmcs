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
          950: "#050c1a",
          900: "#0a1428",
          800: "#0f1f3d",
          700: "#16294f",
          600: "#1e3a63",
          500: "#2c4d7a",
        },
        gold: {
          600: "#c99a34",
          500: "#e8b84b",
          400: "#f0c866",
          300: "#f5d78c",
          200: "#f9e6b8",
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
        premium: "0 20px 60px -15px rgba(10, 20, 40, 0.35)",
        card: "0 1px 2px rgba(15, 23, 42, 0.04), 0 8px 24px -8px rgba(15, 23, 42, 0.08)",
        "card-hover": "0 1px 2px rgba(15, 23, 42, 0.06), 0 24px 48px -16px rgba(15, 23, 42, 0.18)",
        glow: "0 0 0 1px rgba(232, 184, 75, 0.25), 0 16px 40px -12px rgba(232, 184, 75, 0.5)",
      },
      transitionTimingFunction: {
        premium: "cubic-bezier(0.16, 1, 0.3, 1)",
      },
    },
  },
  plugins: [],
};
