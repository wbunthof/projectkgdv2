<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * App\Admin
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $straat
 * @property string $huisnummer
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin whereHuisnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin whereStraat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin whereUpdatedAt($value)
 */
	class Admin extends \Eloquent {}
}

namespace App{
/**
 * App\Antwoord
 *
 * @property int $id
 * @property int $NBFS
 * @property int $vraag_id
 * @property string|null $antwoord
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Formonderdeel $formOnderdeel
 * @property-read \App\Gilde $gilden
 * @property-read \App\vraag $vraag
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Antwoord newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Antwoord newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Antwoord query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Antwoord whereAntwoord($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Antwoord whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Antwoord whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Antwoord whereNBFS($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Antwoord whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Antwoord whereVraagId($value)
 */
	class Antwoord extends \Eloquent {}
}

namespace App{
/**
 * App\Bazuinblazen
 *
 * @property int $id
 * @property int|null $leden_id
 * @property int $NBFS_id
 * @property string|null $naam
 * @property string|null $geboortedatum
 * @property int $senioren A
 * @property int $senioren B
 * @property int $senioren C
 * @property int $Junioren
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Gilde $gilde
 * @property-read \App\Leden|null $leden
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bazuinblazen newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bazuinblazen newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bazuinblazen query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bazuinblazen whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bazuinblazen whereGeboortedatum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bazuinblazen whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bazuinblazen whereJunioren($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bazuinblazen whereLedenId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bazuinblazen whereNBFSId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bazuinblazen whereNaam($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bazuinblazen whereSeniorenA($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bazuinblazen whereSeniorenB($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bazuinblazen whereSeniorenC($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bazuinblazen whereUpdatedAt($value)
 */
	class Bazuinblazen extends \Eloquent {}
}

namespace App{
/**
 * App\Deelnamemeerderewedstrijden
 *
 * @property int $id
 * @property int $NBFS_id
 * @property int|null $discipline_id
 * @property string $naam
 * @property string $disciplines
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Gilde $gilde
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Deelnamemeerderewedstrijden newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Deelnamemeerderewedstrijden newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Deelnamemeerderewedstrijden query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Deelnamemeerderewedstrijden whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Deelnamemeerderewedstrijden whereDisciplineId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Deelnamemeerderewedstrijden whereDisciplines($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Deelnamemeerderewedstrijden whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Deelnamemeerderewedstrijden whereNBFSId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Deelnamemeerderewedstrijden whereNaam($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Deelnamemeerderewedstrijden whereUpdatedAt($value)
 */
	class Deelnamemeerderewedstrijden extends \Eloquent {}
}

namespace App{
/**
 * App\Discipline
 *
 * @property int $id
 * @property string $discipline
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Leden $leden
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Discipline newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Discipline newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Discipline query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Discipline whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Discipline whereDiscipline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Discipline whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Discipline whereUpdatedAt($value)
 */
	class Discipline extends \Eloquent {}
}

namespace App{
/**
 * App\Formonderdeel
 *
 * @property int $id
 * @property string $onderdeel
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property bool $vragen
 * @property bool $leden
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Raadsheer[] $raadsheren
 * @property-read int|null $raadsheren_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\vraag[] $vraag
 * @property-read int|null $vraag_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Formonderdeel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Formonderdeel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Formonderdeel query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Formonderdeel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Formonderdeel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Formonderdeel whereLeden($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Formonderdeel whereOnderdeel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Formonderdeel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Formonderdeel whereVragen($value)
 */
	class Formonderdeel extends \Eloquent {}
}

namespace App{
/**
 * App\Gilde
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $locatie
 * @property string|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Antwoord[] $antwoorden
 * @property-read int|null $antwoorden_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Bazuinblazen[] $bazuinblazen
 * @property-read int|null $bazuinblazen_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Deelnamemeerderewedstrijden[] $deelnamMeerdereWedstrijden
 * @property-read int|null $deelnam_meerdere_wedstrijden_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Junioren[] $junioren
 * @property-read int|null $junioren_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Trommen[] $trommen
 * @property-read int|null $trommen_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Vendelen[] $vendelen
 * @property-read int|null $vendelen_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Gilde newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Gilde newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Gilde query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Gilde whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Gilde whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Gilde whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Gilde whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Gilde whereLocatie($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Gilde whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Gilde wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Gilde whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Gilde whereUpdatedAt($value)
 */
	class Gilde extends \Eloquent {}
}

namespace App{
/**
 * App\Junioren
 *
 * @property int $id
 * @property string $voornaam
 * @property string $achternaam
 * @property string $geboortedatum
 * @property int $NBFS_id
 * @property int $juniorenDiscipline_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\JuniorenDiscipline $juniorenDiscipline
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Junioren newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Junioren newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Junioren query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Junioren whereAchternaam($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Junioren whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Junioren whereGeboortedatum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Junioren whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Junioren whereJuniorenDisciplineId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Junioren whereNBFSId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Junioren whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Junioren whereVoornaam($value)
 */
	class Junioren extends \Eloquent {}
}

namespace App{
/**
 * App\JuniorenDiscipline
 *
 * @property int $id
 * @property string $klasse
 * @property int $discipline_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Junioren[] $Junioren
 * @property-read int|null $junioren_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\JuniorenDiscipline newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\JuniorenDiscipline newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\JuniorenDiscipline query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\JuniorenDiscipline whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\JuniorenDiscipline whereDisciplineId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\JuniorenDiscipline whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\JuniorenDiscipline whereKlasse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\JuniorenDiscipline whereUpdatedAt($value)
 */
	class JuniorenDiscipline extends \Eloquent {}
}

namespace App{
/**
 * App\Leden
 *
 * @property int $id
 * @property int $leden_id
 * @property string $voorletter
 * @property string $voornaam
 * @property string|null $tussenvoegsel
 * @property string $achternaam
 * @property string $geboortedatum
 * @property int $discipline_id
 * @property string|null $straat
 * @property string|null $huisnummer
 * @property string|null $plaats
 * @property int|null $gemaakt_NBFS
 * @property int|null $gemaakt_raadsheer
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Bazuinblazen $bazuinblazen
 * @property-read \App\Discipline $discipline
 * @property-read \App\Trommen $trommen
 * @property-read \App\Vendelen $vendelen
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Leden newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Leden newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Leden query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Leden whereAchternaam($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Leden whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Leden whereDisciplineId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Leden whereGeboortedatum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Leden whereGemaaktNBFS($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Leden whereGemaaktRaadsheer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Leden whereHuisnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Leden whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Leden whereLedenId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Leden wherePlaats($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Leden whereStraat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Leden whereTussenvoegsel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Leden whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Leden whereVoorletter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Leden whereVoornaam($value)
 */
	class Leden extends \Eloquent {}
}

namespace App{
/**
 * App\Organiser
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organiser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organiser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organiser query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organiser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organiser whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organiser whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organiser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organiser whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organiser wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organiser whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organiser whereUpdatedAt($value)
 */
	class Organiser extends \Eloquent {}
}

namespace App{
/**
 * Class Raadsheer
 *
 * @mixin Eloquent\
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Formonderdeel[] $formOnderdelen
 * @property-read int|null $form_onderdelen_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\raadsheerrechten[] $rechten
 * @property-read int|null $rechten_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Raadsheer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Raadsheer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Raadsheer query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Raadsheer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Raadsheer whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Raadsheer whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Raadsheer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Raadsheer whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Raadsheer wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Raadsheer whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Raadsheer whereUpdatedAt($value)
 */
	class Raadsheer extends \Eloquent {}
}

namespace App{
/**
 * App\raadsheerrechten
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\raadsheerrechten newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\raadsheerrechten newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\raadsheerrechten query()
 */
	class raadsheerrechten extends \Eloquent {}
}

namespace App{
/**
 * App\Trommen
 *
 * @property int $id
 * @property int|null $leden_id
 * @property int $NBFS_id
 * @property string|null $naam
 * @property string|null $geboortedatum
 * @property int $senioren U
 * @property int $senioren A
 * @property int $senioren B
 * @property int $senioren C
 * @property int $senioren E
 * @property int $Junioren muziektrom
 * @property int $Junioren gildetrom
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Gilde $gilde
 * @property-read \App\Leden|null $leden
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Trommen newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Trommen newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Trommen query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Trommen whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Trommen whereGeboortedatum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Trommen whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Trommen whereJuniorenGildetrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Trommen whereJuniorenMuziektrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Trommen whereLedenId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Trommen whereNBFSId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Trommen whereNaam($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Trommen whereSeniorenA($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Trommen whereSeniorenB($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Trommen whereSeniorenC($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Trommen whereSeniorenE($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Trommen whereSeniorenU($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Trommen whereUpdatedAt($value)
 */
	class Trommen extends \Eloquent {}
}

namespace App{
/**
 * App\Vendelen
 *
 * @property int $id
 * @property int|null $leden_id
 * @property int $NBFS_id
 * @property string|null $naam
 * @property string|null $geboortedatum
 * @property int $senioren C
 * @property int $senioren C+
 * @property int $senioren Acrobatiek
 * @property int $senioren Zonder Acrobatiek 35 t/m 50 jaar
 * @property int $senioren Zonder Acrobatiek 51+ jaar
 * @property int $Junioren
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Gilde $gilde
 * @property-read \App\Leden|null $leden
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vendelen newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vendelen newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vendelen query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vendelen whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vendelen whereGeboortedatum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vendelen whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vendelen whereJunioren($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vendelen whereLedenId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vendelen whereNBFSId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vendelen whereNaam($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vendelen whereSeniorenAcrobatiek($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vendelen whereSeniorenC($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vendelen whereSeniorenC+($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vendelen whereSeniorenZonderAcrobatiek35T/m50Jaar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vendelen whereSeniorenZonderAcrobatiek51+Jaar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vendelen whereUpdatedAt($value)
 */
	class Vendelen extends \Eloquent {}
}

namespace App{
/**
 * App\vraag
 *
 * @property int $id
 * @property string $tekst
 * @property string $extraInfo
 * @property string|null $placeholder
 * @property string|null $minimumValue
 * @property string|null $maximumValue
 * @property string|null $type
 * @property int $verplicht
 * @property string $formonderdeel
 * @property int|null $formonderdeel_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Antwoord[] $antwoord
 * @property-read int|null $antwoord_count
 * @property-read \App\Formonderdeel $formOnderdeel
 * @method static \Illuminate\Database\Eloquent\Builder|\App\vraag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\vraag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\vraag query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\vraag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\vraag whereExtraInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\vraag whereFormonderdeel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\vraag whereFormonderdeelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\vraag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\vraag whereMaximumValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\vraag whereMinimumValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\vraag wherePlaceholder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\vraag whereTekst($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\vraag whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\vraag whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\vraag whereVerplicht($value)
 */
	class vraag extends \Eloquent {}
}

