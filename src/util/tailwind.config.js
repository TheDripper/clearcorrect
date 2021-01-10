module.exports = {
  purge: ["./template/*.php"],
  darkMode: false, // or 'media' or 'class'
  theme: {
    maxHeight: {
      "photo":"35rem"
    },
    colors: {
      white: "#fff",
      pink: "#FB5373",
      white: "#FFFFFF"
    },
    fontSize: {
      xs: ".75rem",
      sm: ".875rem",
      tiny: ".875rem",
      base: "1rem",
      lg: "1.125rem",
      xl: "1.25rem",
      "2xl": "1.5rem",
      "3xl": "1.875rem",
      "4xl": "2.25rem",
      "5xl": "3rem",
      "6xl": "4rem",
      "7xl": "5rem",
      head: "50px",
      "sub-head": "30px",
      body: "18px",
    },
    fontFamily: {
      head: ["Geomanist-bold"],
      body: ["Thesans-reg"],
      "body-bold": ["Thesans-bold"]
    },
    textColor: {
      pink: "#FB5373",
      white: "#FFFFFF"
    },
    backgroundColor: (theme) => ({
      ...theme("colors"),
      "grey": "#2B3034",
      "pink": "#FB5373",
    }),
    extend: {},
  },
  variants: {
    extend: {},
  },
  plugins: [],
  important: true,
};
