document.addEventListener("DOMContentLoaded", function () {
    // ✅ Afficher un message au clic sur un bouton
    document.querySelectorAll("button").forEach(button => {
        button.addEventListener("click", function() {
            alert("Inscription bientôt disponible !");
        });
    });

    // ✅ Gestion du formulaire dynamique selon le type d'utilisateur
    document.getElementById("userType").addEventListener("change", function() {
        let userType = this.value;
        let form = document.getElementById("signupForm");

        // Nettoyer le formulaire avant d'ajouter les champs
        form.innerHTML = `
            <label for="name">Nom :</label>
            <input type="text" id="name" required>
            <label for="email">Email :</label>
            <input type="email" id="email" required>
            <label for="password">Mot de passe :</label>
            <input type="password" id="password" required>
        `;

        // Champs spécifiques selon le type d'utilisateur
        if (userType === "etudiant") {
            form.innerHTML += `
                <label for="diplome">Diplôme :</label>
                <input type="text" id="diplome" required>
            `;
        } else if (userType === "recruteur") {
            form.innerHTML += `
                <label for="entreprise">Entreprise :</label>
                <input type="text" id="entreprise" required>
            `;
        }

        form.innerHTML += `<button type="submit">S'inscrire</button>`;
    });

    // ✅ Redirection après inscription
    function redirectAfterSignup() {
        window.location.href = "dashboard.php";
        return false; // Empêche l'envoi automatique du formulaire
    }

    // ✅ Affichage de la section "À propos" au clic + Ajout d’un bouton "Fermer"
    document.getElementById("show-about").addEventListener("click", function(event) {
        event.preventDefault();
        let aboutSection = document.getElementById("about");
        aboutSection.style.display = "block"; // Affiche la section

        // Ajout d'un bouton pour fermer la section
        if (!document.getElementById("close-about")) {
            let closeBtn = document.createElement("button");
            closeBtn.id = "close-about";
            closeBtn.textContent = "Fermer";
            closeBtn.style.marginTop = "10px";
            closeBtn.addEventListener("click", function() {
                aboutSection.style.display = "none";
            });
            aboutSection.appendChild(closeBtn);
        }
    });
});
console.log("Script chargé !");
document.getElementById("signupForm").addEventListener("submit", function(event) {
    let prenom = document.getElementById("prenom").value;
    
    if (prenom.trim() === "") {
        alert("Le prénom est obligatoire !");
        event.preventDefault();
    }
});
document.querySelector("form").addEventListener("submit", function(event) {
    let password = document.getElementById("password").value;
    let confirmPassword = document.getElementById("confirmPassword").value;

    if (password !== confirmPassword) {
        alert("Les mots de passe ne correspondent pas !");
        event.preventDefault();
    }
});
function filtrerCandidatures() {
    let domaine = document.getElementById("domaine").value;
    let experience = document.getElementById("experience").value;
    let competences = document.getElementById("competences").value.toLowerCase();
    let statut = document.getElementById("statut").value;

    let candidatures = document.querySelectorAll("#candidatures ul li");

    candidatures.forEach(candidat => {
        let text = candidat.textContent.toLowerCase();
        if ((domaine === "tous" || text.includes(domaine)) &&
            (experience === "tous" || text.includes(experience)) &&
            (statut === "tous" || text.includes(statut)) &&
            (competences === "" || text.includes(competences))) {
            candidat.style.display = "block";
        } else {
            candidat.style.display = "none";
        }
    });
}
function ajouterCommentaire() {
    let nom = document.getElementById("nom").value;
    let message = document.getElementById("message").value;

    if (nom && message) {
        let commentaire = document.createElement("p");
        commentaire.innerHTML = `<strong>${nom} :</strong> ${message}`;
        document.getElementById("liste-commentaires").appendChild(commentaire);

        // Réinitialiser les champs après envoi
        document.getElementById("nom").value = "";
        document.getElementById("message").value = "";
    } else {
        alert("Veuillez remplir tous les champs !");
    }
}
function ajouterCommentaire() {
    let nom = document.getElementById("nom").value;
    let message = document.getElementById("message").value;

    if (nom && message) {
        let commentaire = document.createElement("p");
        commentaire.innerHTML = `<strong>${nom} :</strong> ${message}`;
        document.getElementById("liste-commentaires").appendChild(commentaire);

        // Réinitialiser les champs après envoi
        document.getElementById("nom").value = "";
        document.getElementById("message").value = "";

        // Mettre à jour le compteur de commentaires
        let compteur = document.getElementById("compteur-commentaires");
        compteur.textContent = document.getElementById("liste-commentaires").children.length;
    } else {
        alert("Veuillez remplir tous les champs !");
    }
}
