/*Configuration*/
path = {
    server: './',
    scss: 'dev/css/',
    img: 'dev/img/',
    js: 'dev/js/',
    libs: 'dev/js/libs/',
};
global.browser_support = ["ie >= 9", "ie_mob >= 10", "ff >= 10", "chrome >= 34", "safari >= 5", "opera >= 23", "ios >= 7", "android >= 4.4", "bb >= 10"];

/*REQUIRE*/
var gulp = require('gulp');
/*var svgmin = require('gulp-svgmin');*/
var rename = require('gulp-rename');
/*var svgstore = require('gulp-svgstore');*/
var cssnano= require('gulp-cssnano');
var sass= require('gulp-sass');
var plumber= require('gulp-plumber');
var autoprefixer= require('gulp-autoprefixer');
var imagemin= require('gulp-imagemin');
var newer= require('gulp-newer');
var add= require('gulp-add-src');
var concat= require('gulp-concat');
var uglify= require('gulp-uglify');
var spritesmith = require('gulp.spritesmith');
var sourcemaps = require('gulp-sourcemaps');
var browserSync = require('browser-sync').create();
var reload      = browserSync.reload;


var onError = function(err){
    console.log(err);
    this.emit('end');
}

/*JAVASCRIPT*/
gulp.task('js',  function(){
     return gulp.src([path.js+'jquery.js'])
    .pipe(plumber({errorHandler: onError}))
    .pipe(sourcemaps.init())
    .pipe(add.append(path.libs+'fancybox.js'))
    .pipe(add.append(path.libs+'tweenmax.js'))
    .pipe(add.append(path.libs+'scrollmagic.js'))
    .pipe(add.append(path.libs+'debugscroll.js'))
    .pipe(add.append(path.libs+'animation.gsap.js'))
    .pipe(add.append(path.js+'main.js'))
    .pipe(concat('main.min.js'))
    .pipe(uglify('main.min.js'))
    .pipe(sourcemaps.write())
    .pipe(gulp.dest('./'))
    .pipe(reload({stream: true}));
});



/*GENERATION FICHIER SVG
gulp.task('svg', function () {
    return gulp.src(path.img+'/svg/*.svg')
        .pipe(svgmin())
        .pipe(svgstore())
        .pipe(rename("sprite.svg"))
        .pipe(gulp.dest('images/'));
});
*/
/*GENERATION CSS*/
gulp.task('css', ['sprites'],function(){
     return gulp.src(path.scss+'*.scss')
    .pipe(plumber({errorHandler: onError}))
    .pipe(sourcemaps.init())
    .pipe(sass())
    .pipe(autoprefixer({
            browsers: global.browser_support,
            cascade: false
    }))
    .pipe(rename({basename: "style"}))

    .pipe(gulp.dest('./'))
    .pipe(cssnano({zindex: false}))
    .pipe(rename( {
                basename: "style",
                suffix: '.min'
            }))
   .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest('./'))
    .pipe(reload({stream: true}));
});
/*icone sprite png*/
gulp.task('sprites', function(){
     var opts;
     var spriteData;
    spriteData = null;
    opts = {optimizationLevel: 5, progressive: true, interlace: true };
    var sprite = gulp.src(path.img+'/ico/*.png')
    .pipe(plumber({errorHandler: onError}))
    .pipe(newer(path.img+'/ico/*.png'))
    .pipe(spritesmith({
        imgName: 'sprite.png',
        cssName: '_sprite.scss',
        cssTemplate: path.scss+'tools/_sprite.scss.mustache'
   } ));
    sprite.img.pipe(gulp.dest('images/'));
    sprite.css.pipe(gulp.dest(path.scss));
    return sprite;
});
/*GENERATION IMG*/
gulp.task('img',function(){
    opts = {optimizationLevel: 5, progressive: true, interlace: true };
    gulp.src(path.img+'/*.*')
    .pipe(newer(path.img+'/*.*'))
    .pipe(imagemin(opts))
    .pipe(gulp.dest('images/'))
});


/*WATCH*/

gulp.task('watch', ['img','css','js'], function() {
    browserSync.init(null, {
        proxy : "localhost:8888/agexia",
        debugInfo: true,
        open: true
    });
    gulp.watch(path.scss+'**.scss',['css']).on('change', reload);
    gulp.watch(path.js+'*.js',['js']).on('change', reload);
    gulp.watch(path.img+'/*.*',['img']).on('change', reload);
    gulp.watch("*.php").on('change', reload);
});





