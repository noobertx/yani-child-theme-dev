import buildOption from './buildOption';
import headerStyles from './gulp-generates/headers/styles';


// export const themeBuild = {
// 	basic:[ 
// 			'kits/style.css',
// 			'kits/functions.php',
// 			'kits/header.php',
// 			'kits/footer.php',
// 			'kits/index.php',
// 			'kits/loop-single.php',
// 	],

// 	framework:{
// 		src: 'kits/framework/**/*',
// 		dest: "framework"
// 	},
// 	libs:{
// 		src: 'kits/includes/libs/**',
// 		dest: "includes/libs"
// 	},
// 	helpers:{
// 		src: 'kits/includes/helpers/**',
// 		dest: "includes/helpers"
// 	},
// 	customizer:{
// 		src: 'kits/includes/customizer/**/*',
// 		dest: "includes/customizer"
// 	},
// 	templatePosts:{
// 		src: [
// 			'kits/template-parts/post/**/*',
// 		],
// 		dest: "template-parts/post"
// 	},
// 	templateHeader:{
// 		src: [
// 			'kits/template-parts/header/**/*',
// 		],
// 		dest: "template-parts/header"
// 	},
// 	templateTopBar:{
// 		src: [
// 			'kits/template-parts/topbar/**/*',
// 		],
// 		dest: "template-parts/topbar"
// 	}
// }


export const themeBuild = {
	basic:[ 
			'kits/style.css',
			'kits/functions.php',
			'kits/header.php',
			'kits/footer.php',
			'kits/index.php',
			'kits/loop-single.php',
	],

	framework:{
		src: 'kits/framework/**/*',
		dest: "framework"
	},
	libs:{
		src: 'kits/includes/libs/**',
		dest: "includes/libs"
	},
	helpers:{
		src: 'kits/includes/helpers/**',
		dest: "includes/helpers"
	},
	customizer:{
		src: 'kits/includes/customizer/**/*',
		dest: "includes/customizer"
	},
	// templatePosts:{
	// 	src: [
	// 		'kits/template-parts/post/**/*',
	// 	],
	// 	dest: "template-parts/post"
	// },
	mainHeader:{
		src: [
			'gulp-generates/headers/'+headerStyles.main_header_path+"/main.php",

		],
		dest: "template-parts/header"
	},
	headerPartials:{
		src: [
			'kits/template-parts/header/partials/**/*',
			
		],
		dest: "template-parts/header/partials"
	},
	// templateTopBar:{
	// 	src: [
	// 		'kits/template-parts/topbar/**/*',
	// 	],
	// 	dest: "template-parts/topbar"
	// }
}

// console.log(headerStyles);

export default themeBuild;