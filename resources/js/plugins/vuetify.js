import { createVuetify } from "vuetify";

import colors from "vuetify/util/colors";

export default createVuetify({
  theme: {
    defaultTheme: 'light',
    themes: {
      light: {
        dark: false,
        colors: {
          primary: '#7367F0',
          secondary: '#8F9BB3', // Neutral gray
          surface: '#FFFFFF',
          background: '#F4F5FA', // Light grey background typical for admin panels
        },
      },
      dark: {
        dark: true,
        colors: {
          primary: '#7367F0',
          surface: '#312D4B',
          background: '#28243D',
        },
      },
    },
  },
});
