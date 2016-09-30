'use strict'

const gulp = require('gulp');

gulp.task('copy:materialize', function() {
    return gulp.src('vendor/bower/materialize/dist/**/*.*')
        /*.pipe(gulp.dest(function(file) {
            return file.extname === '.js' ? 'js' :
                file.extname === '.css' ? 'css' : 'fonts';
        }));*/
        .pipe(gulp.dest('frontend/web/plugins/materialize'))
});

gulp.task('copy:material-design-icons', function() {
    return gulp.src([
        'vendor/bower/material-design-icons/iconfont/*.css',
        'vendor/bower/material-design-icons/iconfont/MaterialIcons-Regular.*'
    ])
        .pipe(gulp.dest('frontend/web/plugins/material-design-icons/iconfont'))
});

gulp.task('copy:bootbox', function() {
    return gulp.src([
        'vendor/bower/bootbox.js/bootbox.js'
    ])
        .pipe(gulp.dest('backend/web/plugins/bootbox'))
});

gulp.task('copy:admin-lte', function() {
    return gulp.src([
        'vendor/bower/admin-lte/dist/**/*.*'
    ])
        .pipe(gulp.dest('backend/web/plugins/admin-lte'))
});

gulp.task('copy:font-awesome', function() {
    return gulp.src([
        'vendor/bower/font-awesome/**/*.css',
        'vendor/bower/font-awesome/**/*.{otf,eot,svg,ttf,woff,woff2}'
    ])
        .pipe(gulp.dest('backend/web/plugins/font-awesome'))
});

gulp.task('copy', gulp.series(
    'copy:materialize', 'copy:material-design-icons',
    'copy:bootbox', 'copy:admin-lte', 'copy:font-awesome'
));

