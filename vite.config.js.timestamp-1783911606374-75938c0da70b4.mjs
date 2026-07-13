// vite.config.js
import { defineConfig } from "file:///E:/xampp/htdocs/vite/node_modules/vite/dist/node/index.js";
import laravel from "file:///E:/xampp/htdocs/vite/node_modules/laravel-vite-plugin/dist/index.js";
import html from "file:///E:/xampp/htdocs/vite/node_modules/@rollup/plugin-html/dist/es/index.js";
import { glob } from "file:///E:/xampp/htdocs/vite/node_modules/glob/dist/esm/index.js";
function GetFilesArray(query) {
  return glob.sync(query);
}
var pageJsFiles = GetFilesArray("resources/assets/js/*.js");
var vendorJsFiles = GetFilesArray("resources/assets/vendor/js/*.js");
var LibsJsFiles = GetFilesArray("resources/assets/vendor/libs/**/*.js");
var CoreScssFiles = GetFilesArray("resources/assets/vendor/scss/**/!(_)*.scss");
var LibsScssFiles = GetFilesArray("resources/assets/vendor/libs/**/!(_)*.scss");
var LibsCssFiles = GetFilesArray("resources/assets/vendor/libs/**/*.css");
var FontsScssFiles = GetFilesArray("resources/assets/vendor/fonts/!(_)*.scss");
var vite_config_default = defineConfig({
  plugins: [
    laravel({
      input: [
        "resources/css/app.css",
        "resources/assets/css/demo.css",
        "resources/js/app.js",
        ...pageJsFiles,
        ...vendorJsFiles,
        ...LibsJsFiles,
        ...CoreScssFiles,
        ...LibsScssFiles,
        ...LibsCssFiles,
        ...FontsScssFiles
      ],
      refresh: true
    }),
    html()
  ],
  build: {
    rollupOptions: {
      output: {
        manualChunks(id) {
          if (id.includes("node_modules")) {
            return id.toString().split("node_modules/")[1].split("/")[0].toString();
          }
        }
      }
    }
  }
});
export {
  vite_config_default as default
};
//# sourceMappingURL=data:application/json;base64,ewogICJ2ZXJzaW9uIjogMywKICAic291cmNlcyI6IFsidml0ZS5jb25maWcuanMiXSwKICAic291cmNlc0NvbnRlbnQiOiBbImNvbnN0IF9fdml0ZV9pbmplY3RlZF9vcmlnaW5hbF9kaXJuYW1lID0gXCJFOlxcXFx4YW1wcFxcXFxodGRvY3NcXFxcdml0ZVwiO2NvbnN0IF9fdml0ZV9pbmplY3RlZF9vcmlnaW5hbF9maWxlbmFtZSA9IFwiRTpcXFxceGFtcHBcXFxcaHRkb2NzXFxcXHZpdGVcXFxcdml0ZS5jb25maWcuanNcIjtjb25zdCBfX3ZpdGVfaW5qZWN0ZWRfb3JpZ2luYWxfaW1wb3J0X21ldGFfdXJsID0gXCJmaWxlOi8vL0U6L3hhbXBwL2h0ZG9jcy92aXRlL3ZpdGUuY29uZmlnLmpzXCI7aW1wb3J0IHsgZGVmaW5lQ29uZmlnIH0gZnJvbSAndml0ZSc7XG5pbXBvcnQgbGFyYXZlbCBmcm9tICdsYXJhdmVsLXZpdGUtcGx1Z2luJztcbmltcG9ydCBodG1sIGZyb20gJ0Byb2xsdXAvcGx1Z2luLWh0bWwnO1xuaW1wb3J0IHsgZ2xvYiB9IGZyb20gJ2dsb2InO1xuXG4vKipcbiAqIEdldCBGaWxlcyBmcm9tIGEgZGlyZWN0b3J5XG4gKiBAcGFyYW0ge3N0cmluZ30gcXVlcnlcbiAqIEByZXR1cm5zIGFycmF5XG4gKi9cbmZ1bmN0aW9uIEdldEZpbGVzQXJyYXkocXVlcnkpIHtcbiAgcmV0dXJuIGdsb2Iuc3luYyhxdWVyeSk7XG59XG4vKipcbiAqIEpzIEZpbGVzXG4gKi9cbi8vIFBhZ2UgSlMgRmlsZXNcbmNvbnN0IHBhZ2VKc0ZpbGVzID0gR2V0RmlsZXNBcnJheSgncmVzb3VyY2VzL2Fzc2V0cy9qcy8qLmpzJyk7XG5cbi8vIFByb2Nlc3NpbmcgVmVuZG9yIEpTIEZpbGVzXG5jb25zdCB2ZW5kb3JKc0ZpbGVzID0gR2V0RmlsZXNBcnJheSgncmVzb3VyY2VzL2Fzc2V0cy92ZW5kb3IvanMvKi5qcycpO1xuXG4vLyBQcm9jZXNzaW5nIExpYnMgSlMgRmlsZXNcbmNvbnN0IExpYnNKc0ZpbGVzID0gR2V0RmlsZXNBcnJheSgncmVzb3VyY2VzL2Fzc2V0cy92ZW5kb3IvbGlicy8qKi8qLmpzJyk7XG5cbi8qKlxuICogU2NzcyBGaWxlc1xuICovXG4vLyBQcm9jZXNzaW5nIENvcmUsIFRoZW1lcyAmIFBhZ2VzIFNjc3MgRmlsZXNcbmNvbnN0IENvcmVTY3NzRmlsZXMgPSBHZXRGaWxlc0FycmF5KCdyZXNvdXJjZXMvYXNzZXRzL3ZlbmRvci9zY3NzLyoqLyEoXykqLnNjc3MnKTtcblxuLy8gUHJvY2Vzc2luZyBMaWJzIFNjc3MgJiBDc3MgRmlsZXNcbmNvbnN0IExpYnNTY3NzRmlsZXMgPSBHZXRGaWxlc0FycmF5KCdyZXNvdXJjZXMvYXNzZXRzL3ZlbmRvci9saWJzLyoqLyEoXykqLnNjc3MnKTtcbmNvbnN0IExpYnNDc3NGaWxlcyA9IEdldEZpbGVzQXJyYXkoJ3Jlc291cmNlcy9hc3NldHMvdmVuZG9yL2xpYnMvKiovKi5jc3MnKTtcblxuLy8gUHJvY2Vzc2luZyBGb250cyBTY3NzIEZpbGVzXG5jb25zdCBGb250c1Njc3NGaWxlcyA9IEdldEZpbGVzQXJyYXkoJ3Jlc291cmNlcy9hc3NldHMvdmVuZG9yL2ZvbnRzLyEoXykqLnNjc3MnKTtcblxuZXhwb3J0IGRlZmF1bHQgZGVmaW5lQ29uZmlnKHtcbiAgcGx1Z2luczogW1xuICAgIGxhcmF2ZWwoe1xuICAgICAgaW5wdXQ6IFtcbiAgICAgICAgJ3Jlc291cmNlcy9jc3MvYXBwLmNzcycsXG4gICAgICAgICdyZXNvdXJjZXMvYXNzZXRzL2Nzcy9kZW1vLmNzcycsXG4gICAgICAgICdyZXNvdXJjZXMvanMvYXBwLmpzJyxcbiAgICAgICAgLi4ucGFnZUpzRmlsZXMsXG4gICAgICAgIC4uLnZlbmRvckpzRmlsZXMsXG4gICAgICAgIC4uLkxpYnNKc0ZpbGVzLFxuICAgICAgICAuLi5Db3JlU2Nzc0ZpbGVzLFxuICAgICAgICAuLi5MaWJzU2Nzc0ZpbGVzLFxuICAgICAgICAuLi5MaWJzQ3NzRmlsZXMsXG4gICAgICAgIC4uLkZvbnRzU2Nzc0ZpbGVzXG4gICAgICBdLFxuICAgICAgcmVmcmVzaDogdHJ1ZVxuICAgIH0pLFxuICAgIGh0bWwoKVxuICBdLFxuICBidWlsZDoge1xuICAgIHJvbGx1cE9wdGlvbnM6IHtcbiAgICAgIG91dHB1dDoge1xuICAgICAgICBtYW51YWxDaHVua3MoaWQpIHtcbiAgICAgICAgICBpZiAoaWQuaW5jbHVkZXMoJ25vZGVfbW9kdWxlcycpKSB7XG4gICAgICAgICAgICByZXR1cm4gaWQudG9TdHJpbmcoKS5zcGxpdCgnbm9kZV9tb2R1bGVzLycpWzFdLnNwbGl0KCcvJylbMF0udG9TdHJpbmcoKTtcbiAgICAgICAgICB9XG4gICAgICAgIH1cbiAgICAgIH1cbiAgICB9XG4gIH1cbn0pO1xuIl0sCiAgIm1hcHBpbmdzIjogIjtBQUFzUCxTQUFTLG9CQUFvQjtBQUNuUixPQUFPLGFBQWE7QUFDcEIsT0FBTyxVQUFVO0FBQ2pCLFNBQVMsWUFBWTtBQU9yQixTQUFTLGNBQWMsT0FBTztBQUM1QixTQUFPLEtBQUssS0FBSyxLQUFLO0FBQ3hCO0FBS0EsSUFBTSxjQUFjLGNBQWMsMEJBQTBCO0FBRzVELElBQU0sZ0JBQWdCLGNBQWMsaUNBQWlDO0FBR3JFLElBQU0sY0FBYyxjQUFjLHNDQUFzQztBQU14RSxJQUFNLGdCQUFnQixjQUFjLDRDQUE0QztBQUdoRixJQUFNLGdCQUFnQixjQUFjLDRDQUE0QztBQUNoRixJQUFNLGVBQWUsY0FBYyx1Q0FBdUM7QUFHMUUsSUFBTSxpQkFBaUIsY0FBYywwQ0FBMEM7QUFFL0UsSUFBTyxzQkFBUSxhQUFhO0FBQUEsRUFDMUIsU0FBUztBQUFBLElBQ1AsUUFBUTtBQUFBLE1BQ04sT0FBTztBQUFBLFFBQ0w7QUFBQSxRQUNBO0FBQUEsUUFDQTtBQUFBLFFBQ0EsR0FBRztBQUFBLFFBQ0gsR0FBRztBQUFBLFFBQ0gsR0FBRztBQUFBLFFBQ0gsR0FBRztBQUFBLFFBQ0gsR0FBRztBQUFBLFFBQ0gsR0FBRztBQUFBLFFBQ0gsR0FBRztBQUFBLE1BQ0w7QUFBQSxNQUNBLFNBQVM7QUFBQSxJQUNYLENBQUM7QUFBQSxJQUNELEtBQUs7QUFBQSxFQUNQO0FBQUEsRUFDQSxPQUFPO0FBQUEsSUFDTCxlQUFlO0FBQUEsTUFDYixRQUFRO0FBQUEsUUFDTixhQUFhLElBQUk7QUFDZixjQUFJLEdBQUcsU0FBUyxjQUFjLEdBQUc7QUFDL0IsbUJBQU8sR0FBRyxTQUFTLEVBQUUsTUFBTSxlQUFlLEVBQUUsQ0FBQyxFQUFFLE1BQU0sR0FBRyxFQUFFLENBQUMsRUFBRSxTQUFTO0FBQUEsVUFDeEU7QUFBQSxRQUNGO0FBQUEsTUFDRjtBQUFBLElBQ0Y7QUFBQSxFQUNGO0FBQ0YsQ0FBQzsiLAogICJuYW1lcyI6IFtdCn0K
