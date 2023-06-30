const defaultTheme = require("tailwindcss/defaultTheme");

module.exports = {
  content: ["./src/**/*.php"],
  theme: {
    screens: {
      sm: "100%",
      md: "768px",
      lg: "1024px",
      xl: "1280px",
    },
    container: {
      center: true,
      padding: {
        DEFAULT: "1.5rem",
        md: 0,
      },
    },
    extend: {
      fontFamily: {
        japanese: ["Noto Sans JP", ...defaultTheme.fontFamily.sans],
        logo: ["Rubik", ...defaultTheme.fontFamily.sans],
      },
      backgroundImage: {
        "login-illustration":
          "url(../assets/img/gradient-japanese-temple-with-lake/4256096.jpg)",
        index:
          "url(../assets/img/japanese-temple-surrounded-by-nature/4280871.jpg)",
      },
      colors: {
        brand: {
          50: "#E9AFC3",
          100: "#E49FB7",
          200: "#DB7F9F",
          300: "#D25F87",
          400: "#C93F6F",
          500: "#AF315C",
          600: "#872647",
          700: "#5F1B32",
          800: "#37101D",
          900: "#100408",
        },
      },
    },
  },
  plugins: [require("@tailwindcss/forms")],
};
