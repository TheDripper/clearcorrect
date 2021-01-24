module.exports = {
  purge: {
    content: ["./template/*.php"],
    layers: ["components"],
  },
  darkMode: false, // or 'media' or 'class'
  theme: {
    // maxWidth: {
    //   "case-single": "1199px",
    //   "6xl": "4rem"
    // },
    maxHeight: {
      photo: "50rem",
    },
    colors: {
      white: "#fff",
      pink: "#FB5373",
      "div-grey": "#979797",
    },
    fontSize: {
      xs: ".75rem",
      tiny: ".875rem",
      sm: ".8889rem",
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
      "body-bold": ["Thesans-bold"],
      "body-medium": ["Thesans-medium"],
    },
    textColor: {
      pink: "#FB5373",
      white: "#FFFFFF",
      grey: "#2B3034",
      "h5-grey": "#979797",
      green: "#13C9B1",
    },
    backgroundColor: (theme) => ({
      ...theme("colors"),
      grey: "#2B3034",
      pink: "#FB5373",
      "back-grey": "#F4F4F5",
    }),
    borderColor: (theme) => ({
      ...theme("colors"),
      "shadow-grey": "#979797",
      pink: "#FB5373",
      "border-grey": "#E6EAEE",
    }),
    extend: {
    },
  },
  variants: {
    extend: {},
  },
  plugins: [],
  important: true,
};
