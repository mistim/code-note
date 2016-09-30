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

gulp.task('copy', gulp.series('copy:materialize', 'copy:material-design-icons'));

