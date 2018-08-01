INSERT INTO `Utilisateur` (`id_utilisateur`, `prenom`, `nom`, `pseudo`, `email`, `mot_de_passe`, `estAdministrateur`) VALUES (NULL, 'Lucas', 'Marrel', 'lucas69680', 'marrel.lucas@gmail.com', 'lulu69680',true);
INSERT INTO `Photo` (`id_photo`, `id_utilisateur`, `nom`, `date`, `description`) VALUES (NULL, '1', 'Ancre', now(), 'Une magnifique ancre');
INSERT INTO `Photo` (`id_photo`, `id_utilisateur`, `nom`, `date`, `description`) VALUES (NULL, '1', 'Oiseau', now(), 'Un oiseau pensif');
