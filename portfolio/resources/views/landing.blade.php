<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Portfolio | Stefan Seunarine</title>
</head>
<body>
<script type="text/javascript">
    function degToRad(degrees){
        return degrees * (Math.PI / 180)
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
    import * as THREE from 'three';
    import { GLTFLoader } from 'three/addons/loaders/GLTFLoader.js';

    const scene = new THREE.Scene();
    const camera = new THREE.PerspectiveCamera( 75, window.innerWidth / window.innerHeight, 0.1, 1000 );
    const loader = new GLTFLoader();
    camera.position.z = 3.5;

    let isHeld = false;

    let linePoints = [];

    const renderer = new THREE.WebGLRenderer();
    renderer.setSize( window.innerWidth, window.innerHeight );
    document.body.appendChild( renderer.domElement );

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

        var targetRotation = Math.atan2(intersectionPoint.y - cone.position.y, intersectionPoint.x - cone.position.x);

        cone.rotation.z = targetRotation - Math.PI / 2;
    });
    window.addEventListener('mousedown', (event) => {
        isHeld = true;

        heldMouse.x = (event.clientX / window.innerWidth) * 2 - 1;
        heldMouse.y = -(event.clientY / window.innerHeight) * 2 + 1;
    });
    window.addEventListener('mouseup', (event) => {
        isHeld = false;
    })

    /*******************
     *** LOAD MODELS ***
     *******************/
    let earth = undefined;
     loader.load("{{ asset("models/earth.glb") }}", function ( gltf ) {
        earth = gltf.scene;
        scene.add(earth);
        }, undefined, function ( error ) {
        console.error( error );
    });

    const coneGeometry = new THREE.ConeGeometry( 0.5 / 8, 1 / 6, 9 );
    const coneMaterial = new THREE.MeshBasicMaterial( {color: 0x66ccff} );
    const cone = new THREE.Mesh(coneGeometry, coneMaterial ); scene.add( cone );
    scene.add(cone);
    cone.rotation.z = Math.PI / 2;
    cone.position.z += 2;

    let presetRotation = new THREE.Quaternion();
    presetRotation.setFromEuler(new THREE.Euler(-0.646101242381026, 0.4897943172360577, 0.6232695036004764, 'XYZ'));
    var rotationDuration = 2000;
    var rotationStartTime = null;
    let isRotating = false;
    function updateRotation(obj) {
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

    document.addEventListener("keypress", (event) => {
        isRotating = true;
        rotationStartTime = Date.now();
    })

    function animate() {
        (isRotating) ? updateRotation(earth) : null;
        requestAnimationFrame( animate );

        if(isHeld && heldMouse && (heldMouse.x != 0 && heldMouse.y != 0)){
            earth.rotateOnWorldAxis(xAxis, degToRad(heldMouse.y * rotateSpeed));
            earth.rotateOnWorldAxis(yAxis, degToRad(-heldMouse.x * rotateSpeed));
        }

        renderer.render( scene, camera );
    }

    animate();
</script>
</body>
</html>
