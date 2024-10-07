// vite.config.js
import { defineConfig } from "file:///E:/htdocs8/marksense/node_modules/vite/dist/node/index.js";
import laravel from "file:///E:/htdocs8/marksense/node_modules/laravel-vite-plugin/dist/index.js";
import { svelte } from "file:///E:/htdocs8/marksense/node_modules/@sveltejs/vite-plugin-svelte/src/index.js";
import { vitePreprocess } from "file:///E:/htdocs8/marksense/node_modules/@sveltejs/vite-plugin-svelte/src/index.js";
var materialize_files = [
  "./resources/assets/vendor/scss/rtl/core.scss",
  "./resources/assets/vendor/scss/rtl/core-dark.scss",
  "./resources/assets/vendor/scss/rtl/theme-bordered-dark.scss",
  "./resources/assets/vendor/scss/rtl/theme-bordered.scss",
  "./resources/assets/vendor/scss/rtl/theme-default-dark.scss",
  "./resources/assets/vendor/scss/rtl/theme-default.scss",
  "./resources/assets/vendor/scss/rtl/theme-raspberry-dark.scss",
  "./resources/assets/vendor/scss/rtl/theme-raspberry.scss",
  "./resources/assets/vendor/scss/rtl/theme-semi-dark.scss",
  "./resources/assets/vendor/scss/rtl/theme-semi-dark-dark.scss",
  "./resources/assets/vendor/scss/core.scss",
  "./resources/assets/vendor/scss/core-dark.scss",
  "./resources/assets/vendor/scss/theme-bordered-dark.scss",
  "./resources/assets/vendor/scss/theme-bordered.scss",
  "./resources/assets/vendor/scss/theme-default-dark.scss",
  "./resources/assets/vendor/scss/theme-default.scss",
  "./resources/assets/vendor/scss/theme-raspberry-dark.scss",
  "./resources/assets/vendor/scss/theme-raspberry.scss",
  "./resources/assets/vendor/scss/theme-semi-dark.scss",
  "./resources/assets/vendor/scss/theme-semi-dark-dark.scss",
  // './resources/assets/css/demo.css',
  "./resources/assets/vendor/js/helpers.js",
  "./resources/assets/js/config.js",
  // page
  "./resources/assets/vendor/scss/pages/page-auth.scss",
  "./resources/assets/vendor/scss/pages/page-auth.scss",
  // dashboard page
  "./resources/assets/vendor/libs/apex-charts/apexcharts.js",
  "./resources/assets/vendor/libs/swiper/swiper.js"
];
var frontpage = [
  "./resources/js/frontpage.js",
  "./resources/css/frontpage.pcss"
];
var vite_config_default = defineConfig({
  plugins: [
    laravel({
      input: [
        "./resources/sass/app.scss",
        "./resources/sass/font-awesome/css/all.min.css",
        "./resources/js/app.js",
        ...materialize_files,
        ...frontpage
      ],
      refresh: true
    }),
    svelte({
      preprocess: [vitePreprocess({ postcss: true })],
      alias: {
        "@/*": "./resources/js/*",
        "$lib": `/resources/js/lib`,
        "$lib/*": `/resources/js/lib/*`,
        "utils": `/resources/js/utils`,
        "utils/*": `/resources/js/utils/*`,
        "stores": `/resources/js/stores`,
        "stores/*": `/resources/js/stores/*`,
        "@img": "/public/img"
      }
    })
  ],
  server: {
    watch: {
      ignored: ["**/storage/**", "**/public/storage/**/*"]
    },
    usePolling: true
  },
  esbuild: {
    legalComments: "none"
  },
  resolve: {
    alias: {
      "@/*": "./resources/js/*",
      "$lib": `/resources/js/lib`,
      "$lib/*": `/resources/js/lib/*`,
      "utils": `/resources/js/utils`,
      "utils/*": `/resources/js/utils/*`,
      "stores": `/resources/js/stores`,
      "stores/*": `/resources/js/stores/*`,
      "@img": "/public/img"
    },
    extensions: [".js", ".svelte", ".json", ".ts", ".tsx"]
  }
});
export {
  vite_config_default as default
};
//# sourceMappingURL=data:application/json;base64,ewogICJ2ZXJzaW9uIjogMywKICAic291cmNlcyI6IFsidml0ZS5jb25maWcuanMiXSwKICAic291cmNlc0NvbnRlbnQiOiBbImNvbnN0IF9fdml0ZV9pbmplY3RlZF9vcmlnaW5hbF9kaXJuYW1lID0gXCJFOlxcXFxodGRvY3M4XFxcXG1hcmtzZW5zZVwiO2NvbnN0IF9fdml0ZV9pbmplY3RlZF9vcmlnaW5hbF9maWxlbmFtZSA9IFwiRTpcXFxcaHRkb2NzOFxcXFxtYXJrc2Vuc2VcXFxcdml0ZS5jb25maWcuanNcIjtjb25zdCBfX3ZpdGVfaW5qZWN0ZWRfb3JpZ2luYWxfaW1wb3J0X21ldGFfdXJsID0gXCJmaWxlOi8vL0U6L2h0ZG9jczgvbWFya3NlbnNlL3ZpdGUuY29uZmlnLmpzXCI7aW1wb3J0IHsgZGVmaW5lQ29uZmlnIH0gZnJvbSAndml0ZSc7XG5pbXBvcnQgbGFyYXZlbCBmcm9tICdsYXJhdmVsLXZpdGUtcGx1Z2luJztcbmltcG9ydCB7c3ZlbHRlfSBmcm9tIFwiQHN2ZWx0ZWpzL3ZpdGUtcGx1Z2luLXN2ZWx0ZVwiO1xuaW1wb3J0IHsgdml0ZVByZXByb2Nlc3MgfSBmcm9tIFwiQHN2ZWx0ZWpzL3ZpdGUtcGx1Z2luLXN2ZWx0ZVwiO1xuXG5cbmNvbnN0IG1hdGVyaWFsaXplX2ZpbGVzID0gW1xuICAgICcuL3Jlc291cmNlcy9hc3NldHMvdmVuZG9yL3Njc3MvcnRsL2NvcmUuc2NzcycsXG4gICAgJy4vcmVzb3VyY2VzL2Fzc2V0cy92ZW5kb3Ivc2Nzcy9ydGwvY29yZS1kYXJrLnNjc3MnLFxuICAgICcuL3Jlc291cmNlcy9hc3NldHMvdmVuZG9yL3Njc3MvcnRsL3RoZW1lLWJvcmRlcmVkLWRhcmsuc2NzcycsXG4gICAgJy4vcmVzb3VyY2VzL2Fzc2V0cy92ZW5kb3Ivc2Nzcy9ydGwvdGhlbWUtYm9yZGVyZWQuc2NzcycsXG4gICAgJy4vcmVzb3VyY2VzL2Fzc2V0cy92ZW5kb3Ivc2Nzcy9ydGwvdGhlbWUtZGVmYXVsdC1kYXJrLnNjc3MnLFxuICAgICcuL3Jlc291cmNlcy9hc3NldHMvdmVuZG9yL3Njc3MvcnRsL3RoZW1lLWRlZmF1bHQuc2NzcycsXG4gICAgJy4vcmVzb3VyY2VzL2Fzc2V0cy92ZW5kb3Ivc2Nzcy9ydGwvdGhlbWUtcmFzcGJlcnJ5LWRhcmsuc2NzcycsXG4gICAgJy4vcmVzb3VyY2VzL2Fzc2V0cy92ZW5kb3Ivc2Nzcy9ydGwvdGhlbWUtcmFzcGJlcnJ5LnNjc3MnLFxuICAgICcuL3Jlc291cmNlcy9hc3NldHMvdmVuZG9yL3Njc3MvcnRsL3RoZW1lLXNlbWktZGFyay5zY3NzJyxcbiAgICAnLi9yZXNvdXJjZXMvYXNzZXRzL3ZlbmRvci9zY3NzL3J0bC90aGVtZS1zZW1pLWRhcmstZGFyay5zY3NzJyxcbiAgICAnLi9yZXNvdXJjZXMvYXNzZXRzL3ZlbmRvci9zY3NzL2NvcmUuc2NzcycsXG4gICAgJy4vcmVzb3VyY2VzL2Fzc2V0cy92ZW5kb3Ivc2Nzcy9jb3JlLWRhcmsuc2NzcycsXG4gICAgJy4vcmVzb3VyY2VzL2Fzc2V0cy92ZW5kb3Ivc2Nzcy90aGVtZS1ib3JkZXJlZC1kYXJrLnNjc3MnLFxuICAgICcuL3Jlc291cmNlcy9hc3NldHMvdmVuZG9yL3Njc3MvdGhlbWUtYm9yZGVyZWQuc2NzcycsXG4gICAgJy4vcmVzb3VyY2VzL2Fzc2V0cy92ZW5kb3Ivc2Nzcy90aGVtZS1kZWZhdWx0LWRhcmsuc2NzcycsXG4gICAgJy4vcmVzb3VyY2VzL2Fzc2V0cy92ZW5kb3Ivc2Nzcy90aGVtZS1kZWZhdWx0LnNjc3MnLFxuICAgICcuL3Jlc291cmNlcy9hc3NldHMvdmVuZG9yL3Njc3MvdGhlbWUtcmFzcGJlcnJ5LWRhcmsuc2NzcycsXG4gICAgJy4vcmVzb3VyY2VzL2Fzc2V0cy92ZW5kb3Ivc2Nzcy90aGVtZS1yYXNwYmVycnkuc2NzcycsXG4gICAgJy4vcmVzb3VyY2VzL2Fzc2V0cy92ZW5kb3Ivc2Nzcy90aGVtZS1zZW1pLWRhcmsuc2NzcycsXG4gICAgJy4vcmVzb3VyY2VzL2Fzc2V0cy92ZW5kb3Ivc2Nzcy90aGVtZS1zZW1pLWRhcmstZGFyay5zY3NzJyxcbiAgICAvLyAnLi9yZXNvdXJjZXMvYXNzZXRzL2Nzcy9kZW1vLmNzcycsXG5cblxuICAgICcuL3Jlc291cmNlcy9hc3NldHMvdmVuZG9yL2pzL2hlbHBlcnMuanMnLFxuICAgICcuL3Jlc291cmNlcy9hc3NldHMvanMvY29uZmlnLmpzJyxcblxuICAgIC8vIHBhZ2VcbiAgICAnLi9yZXNvdXJjZXMvYXNzZXRzL3ZlbmRvci9zY3NzL3BhZ2VzL3BhZ2UtYXV0aC5zY3NzJyxcbiAgICAnLi9yZXNvdXJjZXMvYXNzZXRzL3ZlbmRvci9zY3NzL3BhZ2VzL3BhZ2UtYXV0aC5zY3NzJyxcblxuICAgIC8vIGRhc2hib2FyZCBwYWdlXG4gICAgJy4vcmVzb3VyY2VzL2Fzc2V0cy92ZW5kb3IvbGlicy9hcGV4LWNoYXJ0cy9hcGV4Y2hhcnRzLmpzJyxcbiAgICAnLi9yZXNvdXJjZXMvYXNzZXRzL3ZlbmRvci9saWJzL3N3aXBlci9zd2lwZXIuanMnXG5dO1xuXG5jb25zdCBmcm9udHBhZ2UgPSBbXG4gICAgJy4vcmVzb3VyY2VzL2pzL2Zyb250cGFnZS5qcycsXG4gICAgJy4vcmVzb3VyY2VzL2Nzcy9mcm9udHBhZ2UucGNzcydcbl07XG5cbmV4cG9ydCBkZWZhdWx0IGRlZmluZUNvbmZpZyh7XG4gICAgcGx1Z2luczogW1xuICAgICAgICBsYXJhdmVsKHtcbiAgICAgICAgICAgIGlucHV0OiBbXG4gICAgICAgICAgICAgICAgJy4vcmVzb3VyY2VzL3Nhc3MvYXBwLnNjc3MnLFxuICAgICAgICAgICAgICAgICcuL3Jlc291cmNlcy9zYXNzL2ZvbnQtYXdlc29tZS9jc3MvYWxsLm1pbi5jc3MnLFxuICAgICAgICAgICAgICAgICcuL3Jlc291cmNlcy9qcy9hcHAuanMnLFxuICAgICAgICAgICAgICAgIC4uLm1hdGVyaWFsaXplX2ZpbGVzLFxuICAgICAgICAgICAgICAgIC4uLmZyb250cGFnZSxcbiAgICAgICAgICAgIF0sXG4gICAgICAgICAgICByZWZyZXNoOiB0cnVlLFxuICAgICAgICB9KSxcbiAgICAgICAgc3ZlbHRlKHtcbiAgICAgICAgICAgIHByZXByb2Nlc3M6IFt2aXRlUHJlcHJvY2Vzcyh7IHBvc3Rjc3M6IHRydWUgfSldLFxuICAgICAgICAgICAgYWxpYXM6e1xuICAgICAgICAgICAgICAgIFwiQC8qXCI6IFwiLi9yZXNvdXJjZXMvanMvKlwiLFxuICAgICAgICAgICAgICAgICckbGliJzogYC9yZXNvdXJjZXMvanMvbGliYCxcbiAgICAgICAgICAgICAgICAnJGxpYi8qJzogYC9yZXNvdXJjZXMvanMvbGliLypgLFxuICAgICAgICAgICAgICAgICd1dGlscyc6IGAvcmVzb3VyY2VzL2pzL3V0aWxzYCxcbiAgICAgICAgICAgICAgICAndXRpbHMvKic6IGAvcmVzb3VyY2VzL2pzL3V0aWxzLypgLFxuICAgICAgICAgICAgICAgICdzdG9yZXMnOiBgL3Jlc291cmNlcy9qcy9zdG9yZXNgLFxuICAgICAgICAgICAgICAgICdzdG9yZXMvKic6IGAvcmVzb3VyY2VzL2pzL3N0b3Jlcy8qYCxcbiAgICAgICAgICAgICAgICBcIkBpbWdcIjogXCIvcHVibGljL2ltZ1wiLFxuICAgICAgICAgICAgfVxuICAgICAgICB9KSxcbiAgICBdLFxuICAgIHNlcnZlcjoge1xuICAgICAgICB3YXRjaDoge1xuICAgICAgICAgIGlnbm9yZWQ6IFtcIioqL3N0b3JhZ2UvKipcIiwgJyoqL3B1YmxpYy9zdG9yYWdlLyoqLyonXSxcbiAgICAgICAgfSxcbiAgICAgICAgdXNlUG9sbGluZzogdHJ1ZSxcbiAgICB9LFxuICAgIGVzYnVpbGQ6IHtcbiAgICAgICAgbGVnYWxDb21tZW50czogXCJub25lXCIsXG4gICAgfSxcbiAgICByZXNvbHZlOntcbiAgICAgICAgYWxpYXM6IHtcbiAgICAgICAgICAgIFwiQC8qXCI6IFwiLi9yZXNvdXJjZXMvanMvKlwiLFxuICAgICAgICAgICAgJyRsaWInOiBgL3Jlc291cmNlcy9qcy9saWJgLFxuICAgICAgICAgICAgJyRsaWIvKic6IGAvcmVzb3VyY2VzL2pzL2xpYi8qYCxcbiAgICAgICAgICAgICd1dGlscyc6IGAvcmVzb3VyY2VzL2pzL3V0aWxzYCxcbiAgICAgICAgICAgICd1dGlscy8qJzogYC9yZXNvdXJjZXMvanMvdXRpbHMvKmAsXG4gICAgICAgICAgICAnc3RvcmVzJzogYC9yZXNvdXJjZXMvanMvc3RvcmVzYCxcbiAgICAgICAgICAgICdzdG9yZXMvKic6IGAvcmVzb3VyY2VzL2pzL3N0b3Jlcy8qYCxcbiAgICAgICAgICAgIFwiQGltZ1wiOiBcIi9wdWJsaWMvaW1nXCIsXG4gICAgICAgIH0sXG4gICAgICAgIGV4dGVuc2lvbnM6IFtcIi5qc1wiLCBcIi5zdmVsdGVcIiwgXCIuanNvblwiLCAnLnRzJywgJy50c3gnXSxcbiAgICB9XG59KTtcbiJdLAogICJtYXBwaW5ncyI6ICI7QUFBb1AsU0FBUyxvQkFBb0I7QUFDalIsT0FBTyxhQUFhO0FBQ3BCLFNBQVEsY0FBYTtBQUNyQixTQUFTLHNCQUFzQjtBQUcvQixJQUFNLG9CQUFvQjtBQUFBLEVBQ3RCO0FBQUEsRUFDQTtBQUFBLEVBQ0E7QUFBQSxFQUNBO0FBQUEsRUFDQTtBQUFBLEVBQ0E7QUFBQSxFQUNBO0FBQUEsRUFDQTtBQUFBLEVBQ0E7QUFBQSxFQUNBO0FBQUEsRUFDQTtBQUFBLEVBQ0E7QUFBQSxFQUNBO0FBQUEsRUFDQTtBQUFBLEVBQ0E7QUFBQSxFQUNBO0FBQUEsRUFDQTtBQUFBLEVBQ0E7QUFBQSxFQUNBO0FBQUEsRUFDQTtBQUFBO0FBQUEsRUFJQTtBQUFBLEVBQ0E7QUFBQTtBQUFBLEVBR0E7QUFBQSxFQUNBO0FBQUE7QUFBQSxFQUdBO0FBQUEsRUFDQTtBQUNKO0FBRUEsSUFBTSxZQUFZO0FBQUEsRUFDZDtBQUFBLEVBQ0E7QUFDSjtBQUVBLElBQU8sc0JBQVEsYUFBYTtBQUFBLEVBQ3hCLFNBQVM7QUFBQSxJQUNMLFFBQVE7QUFBQSxNQUNKLE9BQU87QUFBQSxRQUNIO0FBQUEsUUFDQTtBQUFBLFFBQ0E7QUFBQSxRQUNBLEdBQUc7QUFBQSxRQUNILEdBQUc7QUFBQSxNQUNQO0FBQUEsTUFDQSxTQUFTO0FBQUEsSUFDYixDQUFDO0FBQUEsSUFDRCxPQUFPO0FBQUEsTUFDSCxZQUFZLENBQUMsZUFBZSxFQUFFLFNBQVMsS0FBSyxDQUFDLENBQUM7QUFBQSxNQUM5QyxPQUFNO0FBQUEsUUFDRixPQUFPO0FBQUEsUUFDUCxRQUFRO0FBQUEsUUFDUixVQUFVO0FBQUEsUUFDVixTQUFTO0FBQUEsUUFDVCxXQUFXO0FBQUEsUUFDWCxVQUFVO0FBQUEsUUFDVixZQUFZO0FBQUEsUUFDWixRQUFRO0FBQUEsTUFDWjtBQUFBLElBQ0osQ0FBQztBQUFBLEVBQ0w7QUFBQSxFQUNBLFFBQVE7QUFBQSxJQUNKLE9BQU87QUFBQSxNQUNMLFNBQVMsQ0FBQyxpQkFBaUIsd0JBQXdCO0FBQUEsSUFDckQ7QUFBQSxJQUNBLFlBQVk7QUFBQSxFQUNoQjtBQUFBLEVBQ0EsU0FBUztBQUFBLElBQ0wsZUFBZTtBQUFBLEVBQ25CO0FBQUEsRUFDQSxTQUFRO0FBQUEsSUFDSixPQUFPO0FBQUEsTUFDSCxPQUFPO0FBQUEsTUFDUCxRQUFRO0FBQUEsTUFDUixVQUFVO0FBQUEsTUFDVixTQUFTO0FBQUEsTUFDVCxXQUFXO0FBQUEsTUFDWCxVQUFVO0FBQUEsTUFDVixZQUFZO0FBQUEsTUFDWixRQUFRO0FBQUEsSUFDWjtBQUFBLElBQ0EsWUFBWSxDQUFDLE9BQU8sV0FBVyxTQUFTLE9BQU8sTUFBTTtBQUFBLEVBQ3pEO0FBQ0osQ0FBQzsiLAogICJuYW1lcyI6IFtdCn0K
