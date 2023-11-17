// auth.js
import { initializeApp } from "https://www.gstatic.com/firebasejs/10.6.0/firebase-app.js";
import { getAuth, signInWithEmailAndPassword, signOut } from "https://www.gstatic.com/firebasejs/10.6.0/firebase-auth.js";

const firebaseConfig = {
    apiKey: "AIzaSyBiim_tLVhRlII6Aro9JXdJw2RpwSRnCqY",
    authDomain: "soa9a-b71b2.firebaseapp.com",
    projectId: "soa9a-b71b2",
    storageBucket: "soa9a-b71b2.appspot.com",
    messagingSenderId: "528101012426",
    appId: "1:528101012426:web:05251f0c1799ef69a4d533"
  };

const app = initializeApp(firebaseConfig);
const auth = getAuth();

// Función para iniciar sesión
async function iniciarSesion(email, password) {
  try {
    const userCredential = await signInWithEmailAndPassword(auth, email, password);
    const user = userCredential.user;
    console.log('Inicio de sesión exitoso:', user);

    // Redirige según las credenciales
    if (email === "admin@admin.com" && password === "admin1") {
      window.location.href = "/admin/home.html";
    } else {
      window.location.href = "index.html";
    }
  } catch (error) {
    console.error('Error al iniciar sesión:', error.message);
    // Puedes mostrar un mensaje de error al usuario o realizar otras acciones necesarias.
  }
}

// Función para cerrar sesión
async function cerrarSesion() {
  try {
    await signOut(auth);
    // Redirige al usuario a la página de inicio de sesión después del cierre de sesión
    window.location.href = "login.html";
  } catch (error) {
    console.error('Error al cerrar sesión:', error);
  }
}

export { iniciarSesion, cerrarSesion, app, auth };
