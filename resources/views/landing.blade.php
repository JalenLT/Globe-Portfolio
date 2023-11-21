<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env("APP_NAME") }}</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .dot-gradient {
            background-image: radial-gradient(#212121 20%, transparent 20%), radial-gradient(#212121 20%, transparent 20%);
            background-color: #ffffff;
            background-position: 0 0, 50px 50px;
            background-size: 100px 100px;
        }
        .diagonal-transparent {
            background: linear-gradient(to bottom left, rgba(0, 0, 0, 0.267), rgba(255, 192, 203, 0), rgba(255, 192, 203, 0));
        }
        .fade-in{
            opacity: 0;
        }
        .slide-top-down{
            transform: translateY(100px);
        }
    </style>
</head>
<body>
    <div id="timeline-container" class="position-absolute w-100 h-100 overflow-auto py-5"></div>

    <div class="position-absolute bottom-0 start-0">
        <div class="d-flex">
            <a href="mailto:seunarine.stefan.lt@gmail.com"" class="btn btn-outline-light mx-2 mb-3"><i class="fa-solid fa-envelope"></i></a>
            <a target="_blank" href="https://www.linkedin.com/in/stefan-seunarine-199618201/" class="btn btn-outline-light mx-2 mb-3"><i class="fa-brands fa-linkedin"></i></a>
            <a target="_blank" href="https://github.com/JalenLT" class="btn btn-outline-light mx-2 mb-3"><i class="fa-brands fa-square-github"></i></a>
        </div>
    </div>

    <div class="position-absolute bottom-0 end-0">
        <div class="d-flex align-items-end">
            <span class="fs-2 fw-light text-light">Stefan Seunarine</span>
            <span class="mx-2 mb-1 fw-bold fs-5 text-light">© <script>document.write(new Date().getFullYear())</script></span>
        </div>
    </div>
    <script type="text/javascript">
        function degToRad(degrees){
            return degrees * (Math.PI / 180)
        }
        function getRandomArbitrary(min, max) {
            return Math.random() * (max - min) + min;
        }
        function buildUIItem(title, subtitle, description){
            return `
                <div class="container-fluid ui-item">
                    <div class="row">
                        <div class="col-6"></div>
                        <div class="col-6">
                            <div class="">
                                <div name="timeline_item" class="container-fluid">
                                    <div class="row mx-5 my-2 rounded-3 fade-in">
                                        <div class="col-lg-1 d-flex justify-content-center align-items-center">
                                            <i class="fa-solid fa-circle fade-in text-light"></i>
                                        </div>
                                        <div class="col-lg-11 overflow-hidden">
                                            <span name="timeline_title" class="fs-3 ps-2 fw-bolder d-block fade-in" style='color: #e6ffff'>` + title + `</span>
                                        </div>
                                        <div class="col-lg-1 d-flex justify-content-center align-items-center overflow-hidden">
                                            <div class="vr text-light" style="width: 5px !important; opacity: 1;"></div>
                                        </div>
                                        <div class="col-lg-11">
                                            <span name="timeline_subtitle" class="fs-5 ps-2 d-block fade-in text-light fw-medium">` + subtitle + `</span>
                                        </div>
                                        <div class="col-lg-1 d-flex justify-content-center align-items-center overflow-hidden">
                                            <div class="vr text-light" style="width: 5px !important; opacity: 1;"></div>
                                        </div>
                                        <div class="col-lg-11">
                                            <span name="timeline_description" class="fs-5 ps-2 d-block fade-in text-light">` + description + `</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        }
    </script>
    <script type="importmap">
        {
            "imports": {
            "three": "https://unpkg.com/three@0.158.0/build/three.module.js",
            "three/addons/": "https://unpkg.com/three@0.158.0/examples/jsm/",
            "three/addons/loaders/GLTFLoader.js": "https://unpkg.com/three@0.158.0/examples/jsm/loaders/GLTFLoader.js",
            "three/addons/postprocessing/EffectComposer.js": "https://unpkg.com/three@0.158.0/examples/jsm/postprocessing/EffectComposer.js",
            "three/addons/postprocessing/RenderPass.js": "https://unpkg.com/three@0.158.0/examples/jsm/postprocessing/RenderPass.js",
            "three/addons/postprocessing/OutputPass.js": "https://unpkg.com/three@0.158.0/examples/jsm/postprocessing/OutputPass.js",
            "three/addons/postprocessing/UnrealBloomPass.js": "https://unpkg.com/three@0.158.0/examples/jsm/postprocessing/UnrealBloomPass.js"
            }
        }
    </script>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    @vite('resources/js/main.js')
    <script type="module" src="{{ Vite::asset('resources/js/anime_test.js') }}"></script>
    <script type="module" data-profile-image="{{ asset("images/tree.png") }}">
        /****************************
         *** INITIALIZE VARIABLES ***
        *****************************/
        var triggerFadeIn = new CustomEvent('trigger-fade-in');
        var triggerFadeOut = new CustomEvent('trigger-fade-out');

        const educationData = [
            {
                title: "University of Bedfordshire",
                subtitle: "Bachelor of Science - BS, Information Technology",
                description: "First Class Honours<br>Jan 2023 - Sep 2023"
            },
            {
                title: "The University of Trinidad and Tobago",
                subtitle: "Diploma, Computer Software Engineering",
                description: "2018 - 2020"
            }
        ];
        const experienceData = [
            {
                title: "Information Technology Analyst / Programmer",
                subtitle: "Ministry of the Attorney General Trinidad and Tobago",
                description: `
                    Dec 2022 - Present (11 months)
                `
            },
            {
                title: "Junior Programmer",
                subtitle: "Ministry of the Attorney General Trinidad and Tobago",
                description: `
                    Jul 2021 - Nov 2022 (1 year 5 months)
                `
            }
        ];
        const projectData = [
            {
                title: "AGLA Careers: Innovative Vacancy Solution for the Office of the Attorney General and Ministry of Legal Affairs",
                subtitle: "As a developer on this project, I played an important role in the creation of AGLA Careers, a cuttingedge solution designed to streamline the management of both internal and external job vacancies within the Office of the Attorney General and Ministry of Legal Affairs (AGLA).",
                description: `
                <span class='fw-bolder'>Key Accomplishments</span> <br>&emsp;<span class='fw-light'>1. User-Focused Front End: Crafted the user interface with HTML, JavaScript, and other essential technologies, ensuring a user-friendly and engaging experience for both job seekers and hiring personnel.<br>&emsp; 2. Enhanced Recruitment Process: Collaborated closely with the project team to improve the recruitment workflow, enabling AGLA to attract, assess, and select the most qualified candidates efficiently.<br>&emsp; 3. Scalability: Designed the platform with scalability in mind, making it adaptable to the evolving needs of the Ministry as it continues to grow. This modularity allows for seamless updates and enhancements.<br>&emsp; 4. Innovation and Relevance: Ensured that "AGLA Careers" remains relevant and innovative, capable of meeting future challenges in the realm of talent acquisition and human resources.</span><br><br><span class='fw-bolder'>Technical Skills Utilized</span><br>&emsp; <span class='fw-light'>1. Front-End Development: Proficiently employed HTML, JavaScript, and other front-end technologies to create an intuitive and dynamic user interface.<br>&emsp; 2. User Experience (UX) Design: Prioritized the user experience, resulting in an interface that is both user-friendly and aesthetically pleasing.<br>&emsp; 3. Scalable Design: Employed best practices for building modular, scalable web applications, allowing for ongoing updates and improvements.<br>&emsp; 4. Collaboration: Worked closely with cross-functional teams to align the front-end design with the project's broader objectives.</span>
                `
            },
            {
                title: "Electronic File Management System for the Office of the Attorney General and Ministry of Legal Affairs",
                subtitle: "As the lead developer, I spearheaded the design and development of the Electronic File Management System, a transformative solution for the Office of the Attorney General and Ministry of Legal Affairs. In a ministry where all information was traditionally recorded on physical files, this web application was created to address several critical challenges: ",
                description: `
                <span class='fw-bolder'>Key Accomplishments</span> <br>&emsp;<span class='fw-light'>1. Digital File Creation and Editing: The system enabled the creation, editing, and management of digital files, eliminating the need for physical paperwork. This transition significantly reduced the volume of paper files, saving time and storage space.<br>&emsp; 2. Digital Signatures: Implemented a secure digital signing feature, allowing authorized personnel to add their digital signatures to files. This ensured the authenticity and integrity of the documents.<br>&emsp; 3. User Access Control: Leveraging the Active Directory system, we ensured that only authorized members of the ministry had access to the application. This streamlined user management, eliminating the need for additional accounts and passwords.<br>&emsp; 4. Efficient Collaboration: With digital files accessible to multiple users simultaneously, the application streamlined collaboration and improved efficiency across various departments within the ministry.<br>&emsp; 5. PDF Conversion: To comply with policies requiring physical files, the system automatically converted digital files into PDF format, ready for printing and archiving by the HR registry. This hybrid approach bridged the gap between digital and physical documentation.<br>&emsp; 6. User Adoption: Successfully rolled out the system to the HR department and a select group of users, with plans for expanding the user base across the entire ministry.</span> <br><br><span class='fw-bolder'>Technical Skills Utilized</span><br>&emsp; <span class='fw-light'>1. Web Application Development: Proficiently developed the application using PHP, Laravel, JavaScript, and HTML.<br>&emsp; 2. Database Management: Employed PostgreSQL for efficient data storage and retrieval.<br>&emsp; 3. Active Directory Integration: Expertly integrated the application with the ministry's Active Directory for seamless user access control.<br>&emsp; 4. PDF Generation: Utilized FPDF and FPDI to convert digital files to PDF format.<br>&emsp; 5. Security and Authentication: Implemented robust security measures to protect sensitive data and ensure authorized access.</span>
                `
            },
            {
                title: "Custom Management System for Vacation and Afterschool Center",
                subtitle: "As the lead programmer, I was responsible for the design and development of a bespoke Management System for the Vacation and Afterschool Center within the Office of the Attorney General and Ministry of Legal Affairs. This project aimed to streamline the registration process for parents and enhance the administrative capabilities for the Ministry's staff.",
                description: `
                <span class='fw-bolder'>Key Accomplishments</span> <br>&emsp; <span class='fw-light'>1. Parent Registration Portal: Designed and implemented a user-friendly web interface that allowed parents to easily register their children within the system. This portal simplified the enrollment process, making it convenient for parents.<br>&emsp; 2. Admin Control Panel: Developed a separate secure portal for administrative users, offering features such as child profile management. Admins could view, edit, and delete child profiles, ensuring efficient center operations.<br>&emsp; 3. Activity Logs: Implemented a robust activity logging system, enabling administrators to leave detailed records for each child. This feature enhanced accountability and communication within the center.<br>&emsp; 4. Customized User Roles: Created distinct user roles and permissions, ensuring that only authorized personnel could access sensitive information and functionality.<br>&emsp; 5. Data Security: Prioritized data security by implementing encryption, access controls, and regular backups to protect sensitive information and ensure compliance with privacy regulations.</span>
                `
            }
        ];
        const aboutMeData = [
            {
                title: "<div class='d-flex align-items-center'><img src='{{ asset(env("PROFILE_PICTURE_PATH", "images/tree.png")) }}' class='me-2 rounded-3 border border-3' style='height: 4rem; width: 4rem;' alt='...'>STEFAN SEUNARINE</div>",
                subtitle: "",
                description: `
                    <span class='fw-bolder'>Introduction / Background</span><br><span class='fw-light'>Experienced programmer with a strong foundation in diverse programming languages and frameworks, including PHP, Laravel, JavaScript, Java, C#, and HTML. Proficient in leveraging analytical skills to develop efficient solutions. Committed to staying updated with industry advancements and eager to contribute technical expertise to innovative programming solutions. Enamored with the creation of visually stunning applications which both intuitive and stick in the mind of the user.</span>
                    <span class='fw-bolder'>Passions and Interests</span><br><span class='fw-light'><ul><li>Artificial Intelligence</li><li>UI/UX</li></ul></span>
                    <span class='fw-bolder'>Skills</span><br><span class='fw-light'>Front-End Development   •   Scalable Design   •   Collaboration   •   Active Directory Integration   •   PDF  Generation   •   Security   •   Web Development   •   Backend Development   •   Database Management   •   User Experience (UX) Design </span>
                `
            }
        ];

        /***********************
         *** IMPORT PACKAGES ***
        ***********************/
        import * as THREE from 'three';
        import { GLTFLoader } from 'three/addons/loaders/GLTFLoader.js';
        import { EffectComposer } from 'three/addons/postprocessing/EffectComposer.js';
        import { RenderPass } from 'three/addons/postprocessing/RenderPass.js';
        import { UnrealBloomPass } from 'three/addons/postprocessing/UnrealBloomPass.js';
        import { OutputPass } from 'three/addons/postprocessing/OutputPass.js';

        /*******************
         *** SETUP SCENE ***
        *******************/
        const scene = new THREE.Scene();
        const camera = new THREE.PerspectiveCamera( 75, window.innerWidth / window.innerHeight, 0.1, 1000 );
        const loader = new GLTFLoader();
        const renderer = new THREE.WebGLRenderer();
        const composer = new EffectComposer( renderer );
        renderer.setSize( window.innerWidth, window.innerHeight );
        composer.setSize( window.innerWidth, window.innerHeight );
        document.body.appendChild( renderer.domElement );
        camera.position.z = 3.5;
        const renderPass = new RenderPass( scene, camera );
        composer.addPass( renderPass );
        const bloomPass = new UnrealBloomPass(new THREE.Vector2(window.innerWidth, window.innerHeight), 0.4, 1, 0.6);
        composer.addPass(bloomPass)
        const outputPass = new OutputPass();
        composer.addPass( outputPass );

        let isHeld = false;
        let linePoints = [];

        /*********************
         *** MOUSE CONTROL ***
        *********************/
        const mouse = new THREE.Vector2();
        let heldMouse = {x: 0, y: 0};
        const rotateSpeed = 1.5;
        let currentRotation = new THREE.Vector3();
        window.addEventListener('mousemove', (event) => {
            mouse.x = (event.clientX / window.innerWidth) * 2 - 1;
            mouse.y = -(event.clientY / window.innerHeight) * 2 + 1;

            if(isHeld){
                heldMouse = mouse;
            }

            var raycaster = new THREE.Raycaster();
            raycaster.setFromCamera(mouse, camera);

            var planeNormal = new THREE.Vector3(0, 0, 1);
            var intersectionPoint = new THREE.Vector3();
            raycaster.ray.intersectPlane(new THREE.Plane(planeNormal, 0), intersectionPoint);

            var targetRotation = Math.atan2(intersectionPoint.y - vehicle.position.y, intersectionPoint.x - vehicle.position.x);

            vehicle.rotation.z = targetRotation - Math.PI / 2;
        });
        window.addEventListener('mousedown', (event) => {
            isHeld = true;

            heldMouse.x = (event.clientX / window.innerWidth) * 2 - 1;
            heldMouse.y = -(event.clientY / window.innerHeight) * 2 + 1;
        });
        window.addEventListener('mouseup', (event) => {
            isHeld = false;
        })

        /**************************
         *** AUTOMATIC ROTATION ***
        **************************/
        let experienceRotation = new THREE.Quaternion();
        let educationRotation = new THREE.Quaternion();
        let aboutMeRotation = new THREE.Quaternion();
        let projectsRotation = new THREE.Quaternion();
        let cameraPannedPosition = camera.position.clone();
        let vehiclePannedPosition = undefined;
        let presetRotation = undefined;
        experienceRotation.setFromEuler(new THREE.Euler(-0.31619639837023544, -0.8185814073168974, -0.6237763716766752, 'XYZ'));
        educationRotation.setFromEuler(new THREE.Euler(0.692056402693423, 0.10864975004848018, 1.1022957314945494, 'XYZ'));
        aboutMeRotation.setFromEuler(new THREE.Euler(1.8664010295415794, -0.5840994459000574, -1.265145192577232, 'XYZ'));
        projectsRotation.setFromEuler(new THREE.Euler(-1.9460707410016864, -0.33008632927243065, -1.169701473000568, 'XYZ'));
        cameraPannedPosition.x += 2;
        cameraPannedPosition.z -= 0.2;
        var movementSmoothness = 0.05;
        var rotationDuration = 2000;
        var rotationStartTime = null;
        let isRotating = false;
        let isViewing = false;
        let isPanned = false;
        function updateRotation(obj, presetRotation) {
            if(obj){
                var currentTime = Date.now();
                var deltaTime = currentTime - rotationStartTime;

                if (deltaTime < rotationDuration) {
                    isRotating = true;
                    var t = deltaTime / rotationDuration;
                    obj.quaternion.slerp(presetRotation, t);
                }else{
                    isRotating = false;
                }
            }
        }

        /*******************
         *** LOAD MODELS ***
        *******************/
        var earth = undefined;
        var education = undefined;
        var educationPlane = undefined;
        var experience = undefined;
        var experiencePlane = undefined;
        var aboutMe = undefined;
        var aboutMePlane = undefined;
        var projects = undefined;
        var projectsPlane = undefined;
        var vehicle = undefined;
        var moon = undefined;
        var laptop = undefined;
        var books = undefined;
        var briefcase = undefined;
        var cameraCam = undefined;
        loader.load("{{ asset("models/earth.glb") }}", function ( gltf ) {
            earth = gltf.scene;
            scene.add(earth);
            }, undefined, function ( error ) {
            console.error( error );
        });
        loader.load("{{ asset("models/education.glb") }}", function ( gltf ) {
            education = gltf.scene;
            scene.add(education);
            }, undefined, function ( error ) {
            console.error( error );
        });
        loader.load("{{ asset("models/education_plane.glb") }}", function ( gltf ) {
            educationPlane = gltf.scene;
            scene.add(educationPlane);

            let customMaterial = new THREE.MeshBasicMaterial({ transparent: true, opacity: 0 }); // Create your custom material
            if (educationPlane.material) {
                educationPlane.material = customMaterial;
                educationPlane.material.opacity = 0;
            } else if (educationPlane.children.length > 0) {
                educationPlane.traverse(function (child) {
                if (child.isMesh) {
                    child.material = customMaterial;
                    child.material.opacity = 0;
                }
            });
            }
            }, undefined, function ( error ) {
            console.error( error );
        });
        loader.load("{{ asset("models/experience.glb") }}", function ( gltf ) {
            experience = gltf.scene;
            scene.add(experience);
            }, undefined, function ( error ) {
            console.error( error );
        });
        loader.load("{{ asset("models/experience_plane.glb") }}", function ( gltf ) {
            experiencePlane = gltf.scene;
            scene.add(experiencePlane);

            let customMaterial = new THREE.MeshBasicMaterial({ transparent: true, opacity: 0 }); // Create your custom material
            if (experiencePlane.material) {
                experiencePlane.material = customMaterial;
                experiencePlane.material.opacity = 0;
            } else if (experiencePlane.children.length > 0) {
                experiencePlane.traverse(function (child) {
                if (child.isMesh) {
                    child.material = customMaterial;
                    child.material.opacity = 0;
                }
            });
            }
            }, undefined, function ( error ) {
            console.error( error );
        });
        loader.load("{{ asset("models/about_me.glb") }}", function ( gltf ) {
            aboutMe = gltf.scene;
            scene.add(aboutMe);
            }, undefined, function ( error ) {
            console.error( error );
        });
        loader.load("{{ asset("models/about_me_plane.glb") }}", function ( gltf ) {
            aboutMePlane = gltf.scene;
            scene.add(aboutMePlane);

            let customMaterial = new THREE.MeshBasicMaterial({ transparent: true, opacity: 0 }); // Create your custom material
            if (aboutMePlane.material) {
                aboutMePlane.material = customMaterial;
                aboutMePlane.material.opacity = 0;
            } else if (aboutMePlane.children.length > 0) {
                aboutMePlane.traverse(function (child) {
                if (child.isMesh) {
                    child.material = customMaterial;
                    child.material.opacity = 0;
                }
            });
            }
            }, undefined, function ( error ) {
            console.error( error );
        });
        loader.load("{{ asset("models/projects.glb") }}", function ( gltf ) {
            projects = gltf.scene;
            scene.add(projects);
            }, undefined, function ( error ) {
            console.error( error );
        });
        loader.load("{{ asset("models/projects_plane.glb") }}", function ( gltf ) {
            projectsPlane = gltf.scene;
            scene.add(projectsPlane);

            let customMaterial = new THREE.MeshBasicMaterial({ transparent: true, opacity: 0 }); // Create your custom material
            if (projectsPlane.material) {
                projectsPlane.material = customMaterial;
                projectsPlane.material.opacity = 0;
            } else if (projectsPlane.children.length > 0) {
                projectsPlane.traverse(function (child) {
                if (child.isMesh) {
                    child.material = customMaterial;
                    child.material.opacity = 0;
                }
            });
            }
            }, undefined, function ( error ) {
            console.error( error );
        });
        loader.load("{{ asset("models/vehicle.glb") }}", function ( gltf ) {
            vehicle = gltf.scene;
            scene.add(vehicle);
            vehicle.position.set(0, 0, 1.3);
            vehicle.scale.set(0.08, 0.08, 0.08);
            vehicle.rotation.z = Math.PI / 2;
            vehiclePannedPosition = vehicle.position.clone();
            vehiclePannedPosition.z += 4;
            }, undefined, function ( error ) {
            console.error( error );
        });
        loader.load("{{ asset("models/moon.glb") }}", function ( gltf ) {
            moon = gltf.scene;
            scene.add(moon);
            moon.position.set(-100, -50, -190);
            }, undefined, function ( error ) {
            console.error( error );
        });
        loader.load("{{ asset("models/books.glb") }}", function ( gltf ) {
            books = gltf.scene;
            scene.add(books);
            }, undefined, function ( error ) {
            console.error( error );
        });
        loader.load("{{ asset("models/briefcase.glb") }}", function ( gltf ) {
            briefcase = gltf.scene;
            scene.add(briefcase);
            }, undefined, function ( error ) {
            console.error( error );
        });
        loader.load("{{ asset("models/camera.glb") }}", function ( gltf ) {
            cameraCam = gltf.scene;
            scene.add(cameraCam);
            }, undefined, function ( error ) {
            console.error( error );
        });
        loader.load("{{ asset("models/laptop.glb") }}", function ( gltf ) {
            laptop = gltf.scene;
            scene.add(laptop);
            }, undefined, function ( error ) {
            console.error( error );
        });

        /**********************
         *** SCENE LIGHTING ***
        **********************/
        const pointLight = new THREE.PointLight( 0xB6E7FF, 30, 100 );
        pointLight.position.set( 2, 3, 2 );
        scene.add( pointLight );
        const pointLight2 = new THREE.PointLight( 0x00CFFF, 13, 200 );
        pointLight2.position.set( -3, 0, 0 );
        // scene.add(pointLight2);
        const spotLight = new THREE.SpotLight(0xffffff, 500);
        spotLight.position.set(30, 30, 30);
        scene.add(spotLight);
        const sphereSize = 1;
        const pointLightHelper = new THREE.PointLightHelper( pointLight, sphereSize );
        // scene.add( pointLightHelper );
        const pointLightHelper2 = new THREE.PointLightHelper( pointLight2, sphereSize );
        // scene.add( pointLightHelper2 );
        const spotLightHelper = new THREE.SpotLightHelper(spotLight);
        // scene.add(spotLightHelper);
        const ambientLight = new THREE.AmbientLight(0xffffff, 0.2);
        scene.add(ambientLight);

        const xAxis = new THREE.Vector3(1, 0, 0);
        const yAxis = new THREE.Vector3(0, 1, 0);
        const zAxis = new THREE.Vector3(0, 0, 1);

        /***************
         *** RAYCAST ***
        ***************/
        const raycaster = new THREE.Raycaster();
        // Add an event listener to track mouse movement
        document.addEventListener('mousemove', (event) => {
            // Calculate mouse position in normalized device coordinates (-1 to 1)
            mouse.x = (event.clientX / window.innerWidth) * 2 - 1;
            mouse.y = - (event.clientY / window.innerHeight) * 2 + 1;

            // Update the raycaster
            raycaster.setFromCamera(mouse, camera);

            // Calculate the intersection point with the z = 0 plane
            if(educationPlane && !isViewing){
                let educationIntersection = raycaster.intersectObject(educationPlane);
                if (educationIntersection.length > 0) {
                    // Get the intersection point
                    educationPlane.scale.set(1.2, 1.2, 1.2);
                }else{
                    educationPlane.scale.set(1, 1, 1);
                }
            }
            if(experiencePlane && !isViewing){
                let experienceIntersection = raycaster.intersectObject(experiencePlane);
                if (experienceIntersection.length > 0) {
                    // Get the intersection point
                    experiencePlane.scale.set(1.2, 1.2, 1.2);
                }else{
                    experiencePlane.scale.set(1, 1, 1);
                }
            }
            if(aboutMePlane && !isViewing){
                let aboutMeIntersection = raycaster.intersectObject(aboutMePlane);
                if (aboutMeIntersection.length > 0) {
                    // Get the intersection point
                    aboutMePlane.scale.set(1.2, 1.2, 1.2);
                }else{
                    aboutMePlane.scale.set(1, 1, 1);
                }
            }
            if(projectsPlane && !isViewing){
                let projectsIntersection = raycaster.intersectObject(projectsPlane);
                if (projectsIntersection.length > 0) {
                    // Get the intersection point
                    projectsPlane.scale.set(1.2, 1.2, 1.2);
                }else{
                    projectsPlane.scale.set(1, 1, 1);
                }
            }
        });
        // Add an event listener to track mouse movement
        document.addEventListener('mousedown', (event) => {
            let isClicked = false;
            // Update the raycaster
            raycaster.setFromCamera(mouse, camera);

            // Calculate the intersection point with the z = 0 plane
            if(educationPlane){
                let educationIntersection = raycaster.intersectObject(educationPlane);
                if (educationIntersection.length > 0) {
                    isClicked = true;
                    isRotating = true;
                    rotationStartTime = Date.now();
                    presetRotation = educationRotation;
                    educationPlane.scale.set(1, 1, 1);

                    educationData.forEach(element => {
                        document.querySelector("#timeline-container").innerHTML += buildUIItem(element.title, element.subtitle, element.description);
                        document.dispatchEvent(triggerFadeIn);
                    });
                }
            }
            if(experiencePlane){
                let experienceIntersection = raycaster.intersectObject(experiencePlane);
                if (experienceIntersection.length > 0) {
                    isClicked = true;
                    isRotating = true;
                    rotationStartTime = Date.now();
                    presetRotation = experienceRotation;
                    experiencePlane.scale.set(1, 1, 1);

                    experienceData.forEach(element => {
                        document.querySelector("#timeline-container").innerHTML += buildUIItem(element.title, element.subtitle, element.description);
                        document.dispatchEvent(triggerFadeIn);
                    });
                }
            }
            if(aboutMePlane){
                let aboutMeIntersection = raycaster.intersectObject(aboutMePlane);
                if (aboutMeIntersection.length > 0) {
                    isClicked = true;
                    isRotating = true;
                    rotationStartTime = Date.now();
                    presetRotation = aboutMeRotation;
                    aboutMePlane.scale.set(1, 1, 1);

                    aboutMeData.forEach(element => {
                        document.querySelector("#timeline-container").innerHTML += buildUIItem(element.title, element.subtitle, element.description);
                        document.dispatchEvent(triggerFadeIn);
                    });
                }
            }
            if(projectsPlane){
                let projectsIntersection = raycaster.intersectObject(projectsPlane);
                if (projectsIntersection.length > 0) {
                    isClicked = true;
                    isRotating = true;
                    rotationStartTime = Date.now();
                    presetRotation = projectsRotation;
                    projectsPlane.scale.set(1, 1, 1);

                    projectData.forEach(element => {
                        document.querySelector("#timeline-container").innerHTML += buildUIItem(element.title, element.subtitle, element.description);
                        document.dispatchEvent(triggerFadeIn);
                    });
                }
            }
            if(isClicked){
                isRotating = true;
                isViewing = true;
                rotationStartTime = Date.now();
                cameraPannedPosition = new THREE.Vector3(2, 0, 3.3);
                vehiclePannedPosition = new THREE.Vector3(0, 0, 5.3);
            }else{
                if(isViewing){
                    isRotating = true;
                }
                isViewing = false;
                rotationStartTime = Date.now();
                cameraPannedPosition = new THREE.Vector3(0, 0, 3.5);
                vehiclePannedPosition = new THREE.Vector3(0, 0, 1.3);

                document.dispatchEvent(triggerFadeOut);
            }
        });

        /*************
         *** STARS ***
        *************/
        let starCount = 100;
        let starPositionArray = [];
        let starArray = [];
        for (let i = 0; i < starCount; i++) {
            let starGeometry = new THREE.SphereGeometry(0.1, 5, 5);
            let starMaterial = new THREE.MeshBasicMaterial({color: 0xffffff});
            let starMesh = new THREE.Mesh(starGeometry, starMaterial);
            scene.add(starMesh);
            starArray.push(starMesh);
            starPositionArray[i] = new THREE.Vector3(getRandomArbitrary(-50, 50), getRandomArbitrary(-50, 50), getRandomArbitrary(-50, 50));
        }

        function animate() {
            (moon && earth && !moon.parent.name) ? earth.add(moon) : null;
            if(spotLight && moon && !spotLight.target.name){
                spotLight.target = moon;
                scene.add( spotLight.target );
                moon.add(spotLight);
            }
            (books && earth && !books.parent.name) ? earth.add(books) : null;
            (briefcase && earth && !briefcase.parent.name) ? earth.add(briefcase) : null;
            (cameraCam && earth && !cameraCam.parent.name) ? earth.add(cameraCam) : null;
            (laptop && earth && !laptop.parent.name) ? earth.add(laptop) : null;
            (educationPlane && earth && !educationPlane.parent.name) ? earth.add(educationPlane) : null;
            (education && educationPlane && !education.parent.name) ? educationPlane.add(education) : null;
            (experiencePlane && earth && !experiencePlane.parent.name) ? earth.add(experiencePlane) : null;
            (experience && experiencePlane && !experience.parent.name) ? experiencePlane.add(experience) : null;
            (aboutMePlane && earth && !aboutMePlane.parent.name) ? earth.add(aboutMePlane) : null;
            (aboutMe && aboutMePlane && !aboutMe.parent.name) ? aboutMePlane.add(aboutMe) : null;
            (projectsPlane && earth && !projectsPlane.parent.name) ? earth.add(projectsPlane) : null;
            (projects && projectsPlane && !projects.parent.name) ? projectsPlane.add(projects) : null;

            if(isRotating){
                updateRotation(earth, presetRotation);
                if(camera.position.distanceTo(cameraPannedPosition) < 0.04){
                    rotationStartTime -= 2000;
                    camera.position.set(cameraPannedPosition.x, cameraPannedPosition.y, cameraPannedPosition.z);
                }
                if(vehicle.position.distanceTo(vehiclePannedPosition) < 0.04){
                    rotationStartTime -= 2000;
                    vehicle.position.set(vehiclePannedPosition.x, vehiclePannedPosition.y, vehiclePannedPosition.z);
                }
                camera.position.lerp(cameraPannedPosition, movementSmoothness);
                vehicle.position.lerp(vehiclePannedPosition, movementSmoothness);
            }

            starArray.forEach((star, index) => {
                if(star && earth && !star.parent.name){
                    earth.add(star);
                }
                star.position.lerp(starPositionArray[index], movementSmoothness / 4);
            });

            requestAnimationFrame( animate );

            if(isHeld && heldMouse && (heldMouse.x != 0 && heldMouse.y != 0) && !isViewing){
                earth.rotateOnWorldAxis(xAxis, degToRad(heldMouse.y * rotateSpeed));
                earth.rotateOnWorldAxis(yAxis, degToRad(-heldMouse.x * rotateSpeed));
            }

            composer.render();
        }

        animate();
    </script>
</body>
</html>
