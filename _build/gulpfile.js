const gulp = require('gulp'),
    rename = require("gulp-rename"),
    concat = require("gulp-concat"),
    notify = require('gulp-notify'),
    plumber = require('gulp-plumber'),
    sass = require('gulp-sass')(require('sass')),        
    sassGlob = require('gulp-sass-glob'),
    postcss = require('gulp-postcss'),
    cssdeclsort = require('css-declaration-sorter'),
    autoprefixer = require('autoprefixer'),
    mmq = require('gulp-merge-media-queries'),
	  babel = require('gulp-babel'),
    uglify = require("gulp-uglify");

const jquery = 'jquery-3.6.0.min.js';

const gulpTask = (filename) => {

  const category = (filename === 'simplesimples')? '': '-' + filename;
  
  /**
   * 複数のSASSファイル(.scss)を、一枚のCSSファイルにする
   */

  // 複数のSASSファイル(.scss)を結合する
  gulp.task('css.concat' + category, () => {
    return gulp.src(['src/sass/var' + category + '.scss','src/sass/setting/**/*.scss','src/sass/base/**/*.scss','src/sass/common/**/*.scss','src/sass/design' + category + '/**/*.scss'])
      .pipe(concat(filename + '.uncompressed.scss'))
      .pipe(gulp.dest('./dist/css'));
  });

  // SASSファイル(.scss)をコンパイルする
  gulp.task('sass' + category, () => {
    return gulp
      .src('./dist/css/' + filename + '.uncompressed.scss')
      .pipe(plumber({errorHandler: notify.onError("Error: <%= error.message %>")}))

      // cssファイル内のimportを有効にする
      .pipe(sassGlob())

      // コンパイルする(出力形式： expanded, nested, campact, compressed)
      .pipe(sass({
          outputStyle: 'expanded'
      }))

      // ベンダープレフィックスを付与する(IEは11以上、Androidは4以上、それ以外は最新2バージョンを対象にしている)
      .pipe(postcss([
          autoprefixer({
              "overrideBrowserslist": [
                  "last 2 versions",
                  "ie >= 11",
                  "Android >= 4"
              ],
              cascade: false
          })
      ]))

      // プロパティをアルファベット順に並び替える
      .pipe(postcss([
          cssdeclsort({ order: 'alphabetical' })
      ]))

      // メディアクエリをまとめる
      .pipe(mmq())

      // 出力先を指定する
      .pipe(gulp.dest('./dist/css'));
  });

  // CSSファイルを最小化する(ワンライン)
  gulp.task('css.min' + category, () => {
    return gulp
      .src('./dist/css/' + filename + '.uncompressed.css')
      .pipe(sass({
          outputStyle: 'compressed'
      }))
      .pipe(rename(filename + '.min.css'))
      .pipe(gulp.dest('../assets/css')); //コンパイル後の出力先
  });

  /**
   * 複数のJSファイルを難読化した一ファイルにまとめる
   */

  // JSファイルを結合する
  gulp.task('js.concat' + category, () => {
    return gulp.src(['src/js/first.js','src/js/_common/**/*.js','src/js/_common_advanced/**/*.js','src/js/individual' + category + '/**/*.js','src/js/last' + category + '.js'])
      .pipe(concat(filename + '.concat-es6.js'))
      .pipe(gulp.dest('./dist/js/'));
  });

  // ES6 to ES5
  gulp.task('js.babel' + category, () => {
    return gulp.src('./dist/js/' + filename + '.concat-es6.js')
      .pipe(babel({
        presets: ['@babel/preset-env']
      }))
      .pipe(plumber())
      .pipe(rename(filename + '.uncompressed.js'))
      .pipe(gulp.dest('./dist/js/'));
  });

  // JSファイルを難読化する（ワンライン）
  gulp.task('js.uglify' + category, () => {
    return gulp.src('./dist/js/' + filename + '.uncompressed.js')
      .pipe(plumber())
      .pipe(uglify())
      .pipe(rename(filename + '.compressed.js'))
      .pipe(gulp.dest('./dist/js/'));
  });
  
  // JSファイルをjQueryと結合する
  gulp.task('js.withjquery' + category, () => {
    return gulp.src(['src/js/jquery/' + jquery, './dist/js/' + filename + '.compressed.js'])
      .pipe(concat(filename + '.min.js'))
      .pipe(gulp.dest('../assets/js/'));
  });


  /**
   * 監視する
   */
  gulp.task( 'watch' + category, () => {
    gulp.watch('./src/sass/var' + category + '.scss', gulp.task('css.concat' + category));
    gulp.watch('./src/sass/setting/**/*.scss', gulp.task('css.concat' + category));
    gulp.watch('./src/sass/base/**/*.scss', gulp.task('css.concat' + category));
    gulp.watch('./src/sass/common/**/*.scss', gulp.task('css.concat' + category));
    gulp.watch('./src/sass/design' + category + '/**/*.scss', gulp.task('css.concat' + category));
    gulp.watch('./dist/css/' + filename + '.uncompressed.scss', gulp.task('sass' + category));
    gulp.watch('./dist/css/' + filename + '.uncompressed.css', gulp.task('css.min' + category));
    gulp.watch('./src/js/first.js', gulp.task('js.concat' + category));
    gulp.watch('./src/js/_common/*.js', gulp.task('js.concat' + category));
    gulp.watch('./src/js/_common_advanced/*.js', gulp.task('js.concat' + category));
    gulp.watch('./src/js/individual' + category + '/**/*.js', gulp.task('js.concat' + category));
    gulp.watch('./src/js/last' + category + '.js', gulp.task('js.concat' + category));
    gulp.watch('./dist/js/' + filename + '.concat-es6.js', gulp.task('js.babel' + category));
    gulp.watch('./dist/js/' + filename + '.uncompressed.js', gulp.task('js.uglify' + category));
    gulp.watch('./dist/js/' + filename + '.compressed.js', gulp.task('js.withjquery' + category));
  });
  
}

gulpTask('simplesimples');

// default
gulp.task('default', gulp.series(gulp.parallel('watch')));

