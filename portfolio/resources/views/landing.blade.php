<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env("APP_NAME") }}</title>
</head>
<body>
<script type="text/javascript">
    function degToRad(degrees){
        return degrees * (Math.PI / 180)
    }
    function getRandomArbitrary(min, max) {
        return Math.random() * (max - min) + min;
    }
</script>
<script type="importmap">
    {
        "imports": {
        "three": "https://unpkg.com/three@0.158.0/build/three.module.js",
        "three/addons/": "https://unpkg.com/three@0.158.0/examples/jsm/",
        "three/addons/loaders/GLTFLoader.js": "https://unpkg.com/three@0.158.0/examples/jsm/loaders/GLTFLoader.js"
        }
    }
</script>
<script type="module">
    /***********************
     *** IMPORT PACKAGES ***
     ***********************/
    import * as THREE from 'three';
    import { GLTFLoader } from 'three/addons/loaders/GLTFLoader.js';

    /*******************
     *** SETUP SCENE ***
     *******************/
    const scene = new THREE.Scene();
    const camera = new THREE.PerspectiveCamera( 75, window.innerWidth / window.innerHeight, 0.1, 1000 );
    const loader = new GLTFLoader();
    const renderer = new THREE.WebGLRenderer();
    renderer.setSize( window.innerWidth, window.innerHeight );
    document.body.appendChild( renderer.domElement );
    camera.position.z = 3.5;

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

    /**********************
     *** SCENE LIGHTING ***
     **********************/
    const pointLight = new THREE.PointLight( 0xB6E7FF, 30, 100 );
    pointLight.position.set( 2, 3, 2 );
    scene.add( pointLight );
    const pointLight2 = new THREE.PointLight( 0x00CFFF, 13, 200 );
    pointLight2.position.set( -3, 0, 0 );
    scene.add(pointLight2);
    const sphereSize = 1;
    const pointLightHelper = new THREE.PointLightHelper( pointLight, sphereSize );
    // scene.add( pointLightHelper );
    const pointLightHelper2 = new THREE.PointLightHelper( pointLight2, sphereSize );
    // scene.add( pointLightHelper2 );
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

        renderer.render( scene, camera );
    }

    animate();
</script>
</body>
</html>
