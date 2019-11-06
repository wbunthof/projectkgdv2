Een request komt binnen.
Vervolgens wordt in de routes/web.php de controller bepaald.
Dan wordt in de controller (app/Http/Controllers) een functie uitgevoerd.
-> dit kan door data naar een model (app/SomeFile.php)te sturen.
-> deze bewerkt de database.
En als laatste verstuurt de controller een view (resources/views) terug naar de gebruiker.

-------------------------------------------------------------------------------------------
Variabelen in .env moeten geconfigureerd worden!
-> vooral app_url, database, mail


-------------------------------------------------------------------------------------------
Alle eigen geschreven code zitten in de volgende mappen/bestanden:

Routes:
routes/web.php

Models:
app/Admin.php
app/Bazuinblazen.php
app/Deelname.php
app/Deelnamemeerderewedstrijden.php
app/Discipline.php
app/Geweer.php
app/Gilde.php
app/Gildemis.php
app/Kruishandboog.php
app/Leden.php
app/Optocht.php
app/Organiser.php
app/Raadsheer.php
app/Raadsheerrechten.php
app/Standaardrijden.php
app/Tentoonstelling.php
app/Trommen.php
app/Vendelen.php
app/Vraag.php

Controllers:
app/Http/Controllers
-> met uitzondering van:
auth/ForgotPasswordController.php
auth/RegisterController.php
auth/ResetPasswordController.php
auth/VerificationController.php

CSS:
public/css/all.php
public/css/persoonlijk.css

JavaScript:
public/js/all.php
public/js/persoonlijk.js

Views:
resources/view
-> met uitzondering van:
auth/register.blade.php
auth/verify.blade.php
auth/login.blade.php
auth/passwords/email.blade.php
auth/passwords/reset.blade.php
auth/layouts/app.blade.php

Migrations/Database:
database/migrations
