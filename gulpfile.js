gulp.task('mainfiles', function() {
    return gulp.src(mainBowerFiles({
        "overrides": {
            "bootstrap": {
                "main": [
                    "./dist/js/bootstrap.min.js",
                    "./dist/css/bootstrap.min.css",
                    "./dist/css/bootstrap-theme.min.css"
                ]
            }
        }}))
        .pipe(gulp.dest('dist/mainfiles'))
});