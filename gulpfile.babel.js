import gulp from 'gulp';
import yargs from 'yargs'
import sass from 'gulp-sass'
import cleanCSS from 'gulp-clean-css'
import gulpif from 'gulp-if'
import sourcemaps from 'gulp-sourcemaps'
import gulpIf from 'gulp-if';
import imagemin from 'gulp-imagemin';
import del from 'del';
import concatCss from 'gulp-concat-css';
import webpack from 'webpack-stream';
import named from 'vinyl-named';
import browserSync from 'browser-sync';
import zip from 'gulp-zip';
import replace from 'gulp-replace';
import info from './package.json';
import themeBuild from './themeBuild';
const PRODUCTION = yargs.argv.prod
const server = browserSync.create()
import buildOption from './buildOption';

const paths = {
    styles:{
        src: [
            'dev/assets/scss/bundle.scss',
            'dev/assets/scss/admin.scss'
        ],
        
        dest:'dist/assets/css'
    },
    images:{
        src:'dev/assets/images/**/*.{jpg,jpeg,png,svg,gif}',
        dest:'dist/assets/images'
    },
    makeCSS:{
        src: ['dev/assets/css/custom-properties.css'],
        dest: 'dist/assets/css/'
    },
    combineCSS:{
        src : ['dev/assets/css/custom-properties.css','dist/assets/css/bundle.css'],
        dest: 'dist/assets/css/'
    },
    combineCSSAdmin:{
        src : ['dev/assets/css/custom-properties.css','dist/assets/css/admin.css'],
        dest: 'dist/assets/css/'
    },
    scripts:{
        src:['dev/assets/js/bundle.js','dev/assets/js/admin.js'],
        dest: 'dist/assets/js/'
    },
    package:{
        src:['**/*','!dev{,/**}','!node_modules{,/**}','!packaged{,/**}','!.babelrc','!webpack.config.js','!gulpfile.babel.js','!.gitignore','!.git{,/**}','!package.json','!package-lock.json'],
        dest: 'packaged'
    },
    themeCSS:{
        src:[
            'dev/assets/theme-scss/theme.scss',
        ],
        dest:'dist/assets/css'
    },
    base:{
        src:[
            "index.php"
        ],
        dest:[
            "../sometheme/"
        ]
    },
    genTheme:{
        src:themeBuild,
        dest:'../gen-theme'
    }
}
export const clean = (done) =>{
    return del(['dist'])
}

export const cleanJSDir = (done) =>{
    return del(['dist/assets/js'])
}

export const cleanCSSDir = (done) =>{
    return del(['dist/assets/css'])
}

export const cleanCopy = (done) =>{
    return del(['dist/assets/css/custom-properties.css'])
}
export const styles=  () =>{
    return gulp.src(paths.styles.src)
    .pipe(gulpIf(!PRODUCTION,sourcemaps.init()))

    .pipe(sass().on('error',sass.logError))
    .pipe(gulpif(PRODUCTION,cleanCSS({compatibility:'ie8'})))
    .pipe(gulpIf(!PRODUCTION,sourcemaps.write()))
    .pipe(gulp.dest(paths.styles.dest))
    .pipe(server.stream())
}

export const theme_styles=  () =>{
    return gulp.src(paths.themeCSS.src)
    .pipe(gulpIf(!PRODUCTION,sourcemaps.init()))

    .pipe(sass().on('error',sass.logError))
    .pipe(gulpif(PRODUCTION,cleanCSS({compatibility:'ie8'})))
    .pipe(gulpIf(!PRODUCTION,sourcemaps.write()))
    .pipe(gulp.dest(paths.themeCSS.dest))
    .pipe(server.stream())
}

export const images = () =>{
    return gulp.src(paths.images.src)
    .pipe(gulpif(!PRODUCTION,imagemin()))
    .pipe(gulp.dest(paths.images.dest))
}

export const watch = () =>{
    gulp.watch('dev/assets/scss/**/*.scss',gulp.series(copy,styles,MakeCSS,MakeCSSAdmin,cleanCopy,reload));
    // gulp.watch('dev/assets/scss/**/*.scss',gulp.series(styles,reload));
    gulp.watch('dev/assets/js/*.js',gulp.series(scripts,reload));
    gulp.watch('dev/assets/js/components/*.js',gulp.series(scripts,reload));
    gulp.watch('dev/assets/css/*.css',gulp.series(copy,styles,MakeCSS,MakeCSSAdmin,cleanCopy,reload));
    gulp.watch('**/*.php',reload);
    gulp.watch(paths.images.src,gulp.series(images,reload));
}

export const theme_watch = () =>{
    gulp.watch('dev/assets/theme-scss/*.scss',gulp.series(theme_styles,reload));
    gulp.watch('dev/assets/theme-scss/**/*.scss',gulp.series(theme_styles,reload));
   
}

export const copy = () =>{
    return gulp.src(paths.makeCSS.src).pipe(gulp.dest(paths.makeCSS.dest));
}

export const MakeCSS = () => {
    return gulp.src(paths.combineCSS.src)
    .pipe(concatCss("bundle.css"))
    .pipe(gulp.dest('dist/assets/css'));
}
export const MakeCSSAdmin = () => {
    return gulp.src(paths.combineCSSAdmin.src)
    .pipe(concatCss("admin.css"))
    .pipe(gulp.dest('dist/assets/css'));
}
export const scripts = () => {
    return gulp.src(paths.scripts.src)
    .pipe(named())
    .pipe(webpack())
    .pipe(gulp.dest(paths.scripts.dest))
}
export const serve = (done) => {
    server.init({
        proxy: "http://riseup.local/",
    })
    done();
}
export const reload = (done) => {
    server.reload();
    done();
}
export const compress = () => {
    return gulp.src(paths.package.src)
    .pipe(replace("_themename",info.name))
    .pipe(zip(`${info.name}.zip`))
    .pipe(gulp.dest(paths.package.dest))
}
// export const dev = gulp.series(clean,copy,watch);
export const dev = gulp.series(clean,gulp.parallel(gulp.series(copy,styles,MakeCSS,MakeCSSAdmin,cleanCopy),scripts),serve,watch);
export const build = gulp.series(clean,gulp.parallel(gulp.series(copy,styles,MakeCSS,MakeCSSAdmin,cleanCopy),scripts));
export const bundle = gulp.series(build,compress);

export const devJS = gulp.series(cleanJSDir,scripts);
export const devCSS = gulp.series(cleanCSSDir,copy,styles,MakeCSS,MakeCSSAdmin,cleanCopy);


export const devtheme = gulp.series(serve,theme_watch);
export const devComponents = gulp.series(scripts,theme_styles);
export default dev;


export const getMainHeader = (done) => {

    if(buildOption.header_num){
        themeBuild.mainHeader.src.push("kits/template-parts/header/header-"+buildOption.header_num+".php");
    }

     gulp.src(themeBuild.mainHeader.src)
     .pipe(replace("_themename",info.name))
     .pipe(gulp.dest(paths.genTheme.dest+"/"+themeBuild.mainHeader.dest))
     
    done();
}

export const getHeaderPartials = (done) => {
     gulp.src(themeBuild.headerPartials.src)
     .pipe(replace("_themename",info.name))
     .pipe(gulp.dest(paths.genTheme.dest+"/"+themeBuild.headerPartials.dest))
     
    done();
}



export const getBasic = (done) => {
     gulp.src(themeBuild.basic)
    .pipe(replace("_themename",info.name))
    .pipe(gulp.dest(paths.genTheme.dest))
   

   gulp.src(themeBuild.framework.src)
    .pipe(replace("_themename",info.name))
    .pipe(gulp.dest(paths.genTheme.dest+"/"+themeBuild.framework.dest))


   //  gulp.src(themeBuild.templatePosts.src)
   //  .pipe(replace("_themename",info.name))
   //  .pipe(gulp.dest(paths.genTheme.dest+"/"+themeBuild.templatePosts.dest))

   //  gulp.src(themeBuild.templateHeader.src)
   //  .pipe(replace("_themename",info.name))
   //  .pipe(gulp.dest(paths.genTheme.dest+"/"+themeBuild.templateHeader.dest))

   //  gulp.src(themeBuild.templateTopBar.src)
   //  .pipe(replace("_themename",info.name))
   //  .pipe(gulp.dest(paths.genTheme.dest+"/"+themeBuild.templateTopBar.dest))

    gulp.src(themeBuild.libs.src)
    .pipe(replace("_themename",info.name))
    .pipe(gulp.dest(paths.genTheme.dest+"/"+themeBuild.libs.dest))

    gulp.src(themeBuild.helpers.src)
    .pipe(replace("_themename",info.name))
    .pipe(gulp.dest(paths.genTheme.dest+"/"+themeBuild.helpers.dest))

    gulp.src(themeBuild.customizer.src)
    .pipe(replace("_themename",info.name))
    .pipe(gulp.dest(paths.genTheme.dest+"/"+themeBuild.customizer.dest))

    done();
}
export const generateTheme = gulp.parallel(getBasic,getHeaderPartials,getMainHeader);

