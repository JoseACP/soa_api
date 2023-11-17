// -->This controls the lights of the buttons

let menuBttns = document.querySelectorAll(".menu-button-off");
console.log(menuBttns);

menuBttns.forEach(bttn=>{
	bttn.addEventListener("click", (event)=>{

		menuBttns.forEach( xx=>{
			xx.classList.remove("menu-bttn-active");
		})

		bttn.classList.add("menu-bttn-active");

	})
})

// -->This is the part that activates and deactivates the parts of the menu.
//This is the function that will do the maging
function TurnOnCategory( categoryId ) {
	let menuCategories = document.querySelectorAll(".menu-category");

	menuCategories.forEach(cat=>{
		cat.classList.add("off")
	})

	let catTo = document.getElementById(categoryId);
	catTo.classList.remove("off");
}

function ButtonTurnOn(buttonId,categoryId) {
	let thisBttn = document.getElementById(buttonId);
	thisBttn.addEventListener("click", (event)=>{TurnOnCategory(categoryId)})

}


//These are the buttons that will be triggered...






ButtonTurnOn("menu-entradas","cat-entradas");
ButtonTurnOn("menu-fuertes","cat-fuertes");
ButtonTurnOn("menu-tacos","cat-tacos");
ButtonTurnOn("menu-cortes","cat-cortes");
ButtonTurnOn("menu-sopas","cat-sopas");
ButtonTurnOn("menu-ensaladas","cat-ensaladas");
ButtonTurnOn("menu-bebidas","cat-bebidas");
ButtonTurnOn("menu-complementos","cat-complementos");
ButtonTurnOn("menu-infantiles","cat-infantiles");
ButtonTurnOn("menu-postres","cat-postres");

