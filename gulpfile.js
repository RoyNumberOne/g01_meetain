const gulp = require('gulp');
const cleanCSS = require('gulp-clean-css');
const sass = require('gulp-sass');
const concat = require('gulp-concat');
const fileinclude = require('gulp-file-include');
const browserSync = require('browser-sync');
const reload = browserSync.reload;
const imagemin = require('gulp-imagemin');

gulp.task('hi', function(){
    //在這裡做事
    console.log('測試');
});

gulp.task('copy', function(){
    return gulp.src('dev/index.html').pipe(gulp.dest('dist'));
});


gulp.task('css', function(){
    return gulp.src('dev/css/*.css').pipe(cleanCSS({
        compatibility: 'ie8'
      })).pipe(gulp.dest('dist/css'))
})

gulp.task('sass', function(){
    return gulp.src('./dev/sass/*.scss') //來源
    .pipe(sass().on('error', sass.logError)) //轉譯sass
    .pipe(cleanCSS({
        compatibility: 'ie8'
    })) //壓縮css
        .pipe(gulp.dest('./dist/css')); //目的地
});


gulp.task('all', ['copy' , 'css']); // 同步處理
// $ gulp copy css // 順序異步處理

gulp.task('concat', ['sass'], function(){
    //do
    return gulp.src('dist/css/*.css')    //來源
    .pipe(concat('all.css'))        //合併
    .pipe(gulp.dest('dist/css/all'))    //目的地
})


gulp.task('fileinclude', function(){
    return gulp.src(['dev/index.html']) //來源
    .pipe(fileinclude({
      prefix: '@@',
      basepath: '@file'
    }))
    .pipe(gulp.dest('./dist')); //目的地
});



gulp.task('default',  function () {
    browserSync.init({
      server: {
        baseDir: "./dist",
        index: "index.html"
      }
    });
    gulp.watch('./dev/sass/*.scss', ['sass' , 'concat']).on('change' , reload);
    gulp.watch(['./dev/*.html' , './dev/**/*.html'] , ['fileinclude']).on('change' , reload)
  });


  //壓圖
  gulp.task('img', function () {
    gulp.src('./images/index/morning/*.*')
      .pipe(imagemin())
      .pipe(gulp.dest('dist/images'))
  })


//監看變動
gulp.task('watch', function(){
    gulp.watch('./dev/sass/*.scss', ['sass' , 'concat'])
    gulp.watch(['./dev/*.html' , './dev/**/*.html'] , ['fileinclude'])
})