var gulp = require('gulp'),
  merge = require('gulp-merge-json'),
  mergeStream = require('merge-stream'),

  elixir = require('laravel-elixir'),
  config = elixir.config,
  _ = require('underscore'),
  Elixir = require('laravel-elixir')

elixir.extend('mergeTranslateJson', function (src, output, options) {
  var defaultOptions = {
    moduleName: 'app.partials',
    prefix: './views/'
  }


  var paths = new elixir.GulpPaths()
    .src(src || ['./angular/app/**/locales/*.json'])
    .output(output || './public/locales')

  new elixir.Task('mergeTranslateJson', function () {

      var lan = ['de', 'en', 'fr', 'it'];

      var tasks = [];
      for (var i = 0; i < lan.length; i++) {
          tasks.push(
              gulp.src('./angular/app/**/locales/' + lan[i] + '.json')
                  .pipe(merge({
                      fileName: lan[i] + '.json'
                  }))
                  .pipe(gulp.dest(paths.output.baseDir))
          );
      }
      return mergeStream(tasks);
  })
    .watch(paths.src.path)
})
