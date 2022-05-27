<?php

session_start();

require_once("includes/functions.php");
global $dbconn;
$dbconn = new PDO('mysql:host='.$config['lsb_host'].';dbname='.$config['lsb_name'].';charset=utf8mb4', $config['lsb_user'], $config['lsb_pass']);

if (!empty($_SESSION['catseye'])) {
$users = authenticate($_SESSION['catseye_username']);
}

$droptype_array= array(
0 => "Normal",
1 => "Limited",
2 => "Steal",
3 => "Unknown",
4 => "Despoil"
);

$jobs = array(
0 => "",
1 => "war",
2 => "mnk",
3 => "whm",
4 => "blm",
5 => "rdm",
6 => "thf",
7 => "pld",
8 => "drk",
9 => "bst",
10 => "brd",
11 => "rng",
12 => "sam",
13 => "nin",
14 => "drg",
15 => "smn",
16 => "blu",
17 => "cor",
18 => "pup",
19 => "dnc",
20 => "sch",
21 => "geo",
22 => "run"
);

$slot_array = array(
1=>"Main",
2=>"Sub",
3=>"Main, Sub",
4=>"Ranged",
8=>"Ammo",
16=>"Head",
32=>"Body",
64=>"Hands",
128=>"Legs",
256=>"Feet",
512=>"Neck",
1024=>"Waist",
6144=>"Ears",
24576=>"Rings",
32768=>"Back"
);

$flag_array = array(
0=>"None",
1=>"Wall Hanging",
4=>"Mystery Box",
8=>"Mog Garden",
16=>"Inner Delivery",
32=>"Inscribable",
64=>"No Auction",
99=>"Unknown 99",
128=>"Scroll",
256=>"Linkshell",
512=>"Can Use",
1024=>"Can Trade NPC",
2048=>"Can Equip",
4096=>"No Sale",
8192=>"No Delivery",
16384=>"Ex",
32768=>"Rare"
);

$jobs_array = array(
1=>"war",
2=>"mnk",
4=>"whm",
8=>"blm",
16=>"rdm",
32=>"thf",
64=>"pld",
128=>"drk",
256=>"bst",
512=>"brd",
1024=>"rng",
2048=>"sam",
4096=>"nin",
8192=>"drg",
16384=>"smn",
32768=>"blu",
65536=>"cor",
131072=>"pup",
262144=>"dnc",
524288=>"sch",
1048576=>"geo",
2097152=>"run"
);

$damage = array(
0=>"None",
1=>"Piercing",
2=>"Slashing",
3=>"Blunt",
4=>"Hand-to-Hand",
5=>"Crossbow",
6=>"Gun"
);

$ahcat= array(
0=>"N/A",
1=>"Hand-to-Hand",
2=>"Daggers",
3=>"Swords",
4=>"Great Swords",
5=>"Axes",
6=>"Great Axes",
7=>"Scythes",
8=>"Polearms",
9=>"Katana",
10=>"Great Katana",
11=>"Clubs",
12=>"Staves",
13=>"Ranged",
14=>"Instruments",
15=>"Ammunition",
16=>"Shields",
17=>"Helms",
18=>"Body",
19=>"Gloves",
20=>"Legs",
21=>"Feet",
22=>"Neck",
23=>"Waist",
24=>"Earrings",
25=>"Rings",
26=>"Back",
28=>"White Magic",
29=>"Black Magic",
30=>"Summoning",
31=>"Ninjutsu",
32=>"Songs",
33=>"Medicines",
34=>"Furnishings",
35=>"Crystals",
36=>"Cards",
37=>"Cursed Items",
38=>"Smithing",
39=>"Goldsmithing",
40=>"Clothcraft",
41=>"Leathercraft",
42=>"Bonecraft",
43=>"Woodworking",
44=>"Alchemy",
46=>"Misc.",
47=>"Fishing Gear",
48=>"Pet Items",
49=>"Ninja Tools",
50=>"Beast-made",
51=>"Fish",
52=>"Meat & Eggs",
53=>"Seafood",
54=>"Vegetables",
55=>"Soups",
56=>"Bread & Rice",
57=>"Sweets",
58=>"Drinks",
59=>"Ingredients",
60=>"Dice",
61=>"Automation",
62=>"Grips",
99=>"No AH"
);

$latent = array(
"LATENT_HP_UNDER_PERCENT"=>0,//hplessthanorequalto%-PARAM:HPPERCENT
"LATENT_HP_OVER_PERCENT"=>1,//hpmorethan%-PARAM:HPPERCENT
"LATENT_HP_UNDER_TP_UNDER_100"=>2,//hplessthanorequalto%,tpunder100-PARAM:HPPERCENT
"LATENT_HP_OVER_TP_UNDER_100"=>3,//hpmorethan%,tpover100-PARAM:HPPERCENT
"LATENT_HP_OVER_VISIBLE_GEAR"=>46,//hpmorethanorequalto%,calculatedusingHPbonusesfromvisiblegearonly
"LATENT_MP_UNDER_PERCENT"=>4,//mplessthanorequalto%-PARAM:MPPERCENT
"LATENT_MP_UNDER"=>5,//mplessthan#-PARAM:MP#
"LATENT_MP_UNDER_VISIBLE_GEAR"=>45,//mplessthanorequalto%,calculatedusingMPbonusesfromvisiblegearonly
"LATENT_TP_UNDER"=>6,//tpunder#andduringWS-PARAM:TPVALUE
"LATENT_TP_OVER"=>7,//tpover#-PARAM:TPVALUE
"LATENT_SUBJOB"=>8,//subjob-PARAM:JOBTYPE
"LATENT_PET_ID"=>9,//pettype-PARAM:PETID
"LATENT_WEAPON_DRAWN"=>10,//weapondrawn
"LATENT_WEAPON_SHEATHED"=>11,//weaponsheathed
"LATENT_STATUS_EFFECT_ACTIVE"=>13,//statuseffectonplayer-PARAM:EFFECTID
"LATENT_FOOD_ACTIVE"=>49,//foodeffect(foodId)active-PARAM:FOODITEMID
"LATENT_NO_FOOD_ACTIVE"=>14,//nofoodeffectsactiveonplayer
"LATENT_PARTY_MEMBERS"=>15,//partysize#-PARAM:#OFMEMBERS
"LATENT_PARTY_MEMBERS_IN_ZONE"=>16,//partysize#andmembersinzone-PARAM:#OFMEMBERS
"LATENT_AVATAR_IN_PARTY"=>21,//partyhasaspecificavatar-PARAM:sameasglobals/pets.lua(21foranyavatar)
"LATENT_JOB_IN_PARTY"=>22,//partyhasjob-PARAM:JOBTYPE
"LATENT_ZONE"=>23,//inzone-PARAM:zoneid
"LATENT_SYNTH_TRAINEE"=>24,//synthskillunder40+nosupport
"LATENT_SONG_ROLL_ACTIVE"=>25,//anysongorrollactive
"LATENT_TIME_OF_DAY"=>26,//PARAM:0:DAYTIME1:NIGHTTIME2:DUSK-DAWN
"LATENT_HOUR_OF_DAY"=>27,//PARAM:1:NEWDAY,2:DAWN,3:DAY,4:DUSK,5:EVENING,6:DEADOFNIGHT
"LATENT_FIRESDAY"=>28,
"LATENT_EARTHSDAY"=>29,
"LATENT_WATERSDAY"=>30,
"LATENT_WINDSDAY"=>31,
"LATENT_DARKSDAY"=>32,
"LATENT_ICEDAY"=>34,
"LATENT_LIGHTNINGSDAY"=>35,
"LATENT_LIGHTSDAY"=>36,
"LATENT_MOON_FIRST_QUARTER"=>37,
"LATENT_JOB_MULTIPLE_5"=>38,
"LATENT_JOB_MULTIPLE_10"=>39,
"LATENT_JOB_MULTIPLE_13_NIGHT"=>40,
"LATENT_JOB_LEVEL_ODD"=>41,
"LATENT_JOB_LEVEL_EVEN"=>42,
"LATENT_WEAPON_DRAWN_HP_UNDER"=>43,//PARAM:HPPERCENT
"LATENT_WEAPON_BROKEN"=>47,
"LATENT_IN_DYNAMIS"=>48,
"LATENT_JOB_LEVEL_BELOW"=>50,//PARAM:level
"LATENT_JOB_LEVEL_ABOVE"=>51,//PARAM:level
"LATENT_WEATHER_ELEMENT"=>52,//PARAM:0:NONE,1:FIRE,2:EARTH,3:WATER,4:WIND,5:ICE,6:THUNDER,7:LIGHT,8:DARK
"LATENT_NATION_CONTROL"=>53,//checksifplayerregionisundernation'scontrol-PARAM:0:Underownnation'scontrol,1:Outsideownnation'scontrol
"LATENT_ZONE_HOME_NATION"=>54 //inzoneandcitizenofnation(aketons)
);
$latent_name=array_flip($latent);

$mods = array("NONE"=>0,
"DEF"=>1,
"HP"=>2,
"HPP"=>3,
"CONVMPTOHP"=>4,
"MP"=>5,
"MPP"=>6,
"CONVHPTOMP"=>7,
"STR"=>8,
"DEX"=>9,
"VIT"=>10,
"AGI"=>11,
"INT"=>12,
"MND"=>13,
"CHR"=>14,
"FIREDEF"=>15,
"ICEDEF"=>16,
"WINDDEF"=>17,
"EARTHDEF"=>18,
"THUNDERDEF"=>19,
"WATERDEF"=>20,
"LIGHTDEF"=>21,
"DARKDEF"=>22,
"ATT"=>23,
"RATT"=>24,
"ACC"=>25,
"RACC"=>26,
"ENMITY"=>27,
"ENMITY_LOSS_REDUCTION"=>502,
"MATT"=>28,
"MDEF"=>29,
"MACC"=>30,
"MEVA"=>31,
"FIREATT"=>32,
"ICEATT"=>33,
"WINDATT"=>34,
"EARTHATT"=>35,
"THUNDERATT"=>36,
"WATERATT"=>37,
"LIGHTATT"=>38,
"DARKATT"=>39,
"FIREACC"=>40,
"ICEACC"=>41,
"WINDACC"=>42,
"EARTHACC"=>43,
"THUNDERACC"=>44,
"WATERACC"=>45,
"LIGHTACC"=>46,
"DARKACC"=>47,
"WSACC"=>48,
"SLASHRES"=>49,
"PIERCERES"=>50,
"IMPACTRES"=>51,
"HTHRES"=>52,
"FIRERES"=>54,
"ICERES"=>55,
"WINDRES"=>56,
"EARTHRES"=>57,
"THUNDERRES"=>58,
"WATERRES"=>59,
"LIGHTRES"=>60,
"DARKRES"=>61,
"ATTP"=>62,
"DEFP"=>63,
"COMBAT_SKILLUP_RATE"=>64, //%increaseinskillupcombatrate
"MAGIC_SKILLUP_RATE"=>65, //%increaseinskillupmagicrate
"RATTP"=>66,
"EVA"=>68,
"RDEF"=>69,
"REVA"=>70,
"MPHEAL"=>71,
"HPHEAL"=>72,
"STORETP"=>73,
"HTH"=>80,
"DAGGER"=>81,
"SWORD"=>82,
"GSWORD"=>83,
"AXE"=>84,
"GAXE"=>85,
"SCYTHE"=>86,
"POLEARM"=>87,
"KATANA"=>88,
"GKATANA"=>89,
"CLUB"=>90,
"STAFF"=>91,
"RAMPART_DURATION"=>92, //Rampartdurationinseconds
"FLEE_DURATION"=>93, //Fleedurationinseconds
"MEDITATE_DURATION"=>94, //Meditatedurationinseconds
"WARDING_CIRCLE_DURATION"=>95, //WardingCircledurationinseconds
"SOULEATER_EFFECT"=>96, //Souleaterpowerinpercents
"DESPERATE_BLOWS"=>906, //AddsabilityhastetoLastResort
"STALWART_SOUL"=>907, //ReducesdamagetakenfromSouleater
"BOOST_EFFECT"=>97, //Boostpowerintenths
"CAMOUFLAGE_DURATION"=>98, //Camouflagedurationinpercents
"AUTO_MELEE_SKILL"=>101,
"AUTO_RANGED_SKILL"=>102,
"AUTO_MAGIC_SKILL"=>103,
"ARCHERY"=>104,
"MARKSMAN"=>105,
"THROW"=>106,
"GUARD"=>107,
"EVASION"=>108,
"SHIELD"=>109,
"PARRY"=>110,
"DIVINE"=>111,
"HEALING"=>112,
"ENHANCE"=>113,
"ENFEEBLE"=>114,
"ELEM"=>115,
"DARK"=>116,
"SUMMONING"=>117,
"NINJUTSU"=>118,
"SINGING"=>119,
"STRING"=>120,
"WIND"=>121,
"BLUE"=>122,
"CHAKRA_MULT"=>123, //Chakramultiplierincrease
"CHAKRA_REMOVAL"=>124, //ExtrastatusesremovedbyChakra
"SUPPRESS_OVERLOAD"=>125, //Kenkonken"SuppressesOverload"mod.Unclearhowthisworksexactly.Requirestestingonretail.
"BP_DAMAGE"=>126, //BloodPact:RageDamageincreasepercentage
"FISH"=>127,
"WOOD"=>128,
"SMITH"=>129,
"GOLDSMITH"=>130,
"CLOTH"=>131,
"LEATHER"=>132,
"BONE"=>133,
"ALCHEMY"=>134,
"COOK"=>135,
"SYNERGY"=>136,
"RIDING"=>137,
"ANTIHQ_WOOD"=>144,
"ANTIHQ_SMITH"=>145,
"ANTIHQ_GOLDSMITH"=>146,
"ANTIHQ_CLOTH"=>147,
"ANTIHQ_LEATHER"=>148,
"ANTIHQ_BONE"=>149,
"ANTIHQ_ALCHEMY"=>150,
"ANTIHQ_COOK"=>151,
"DMG"=>160,
"DMGPHYS"=>161,
"DMGBREATH"=>162,
"DMGMAGIC"=>163,
"DMGMAGIC_II"=>831, //MagicDamageTakenII%(Aegis)
"DMGRANGE"=>164,
"UDMGPHYS"=>387,
"UDMGBREATH"=>388,
"UDMGMAGIC"=>389,
"UDMGRANGE"=>390,
"CRITHITRATE"=>165,
"CRIT_DMG_INCREASE"=>421,
"ENEMYCRITRATE"=>166,
"CRIT_DEF_BONUS"=>908, //Reducescrithitdamage
"MAGIC_CRITHITRATE"=>562,
"MAGIC_CRIT_DMG_INCREASE"=>563,
"HASTE_MAGIC"=>167,
"SPELLINTERRUPT"=>168,
"MOVE"=>169,
"FASTCAST"=>170,
"UFASTCAST"=>407,
"CURE_CAST_TIME"=>519,
"ELEMENTAL_CELERITY"=>901, //QuickensElementalMagicCasting
"DELAY"=>171,
"RANGED_DELAY"=>172,
"MARTIAL_ARTS"=>173,
"SKILLCHAINBONUS"=>174,
"SKILLCHAINDMG"=>175,
"FOOD_HPP"=>176,
"FOOD_HP_CAP"=>177,
"FOOD_MPP"=>178,
"FOOD_MP_CAP"=>179,
"FOOD_ATTP"=>180,
"FOOD_ATT_CAP"=>181,
"FOOD_DEFP"=>182,
"FOOD_DEF_CAP"=>183,
"FOOD_ACCP"=>184,
"FOOD_ACC_CAP"=>185,
"FOOD_RATTP"=>186,
"FOOD_RATT_CAP"=>187,
"FOOD_RACCP"=>188,
"FOOD_RACC_CAP"=>189,
"FOOD_MACCP"=>99,
"FOOD_MACC_CAP"=>100,
"VERMIN_KILLER"=>224,
"BIRD_KILLER"=>225,
"AMORPH_KILLER"=>226,
"LIZARD_KILLER"=>227,
"AQUAN_KILLER"=>228,
"PLANTOID_KILLER"=>229,
"BEAST_KILLER"=>230,
"UNDEAD_KILLER"=>231,
"ARCANA_KILLER"=>232,
"DRAGON_KILLER"=>233,
"DEMON_KILLER"=>234,
"EMPTY_KILLER"=>235,
"HUMANOID_KILLER"=>236,
"LUMORIAN_KILLER"=>237,
"LUMINION_KILLER"=>238,
"SLEEPRES"=>240,
"POISONRES"=>241,
"PARALYZERES"=>242,
"BLINDRES"=>243,
"SILENCERES"=>244,
"VIRUSRES"=>245,
"PETRIFYRES"=>246,
"BINDRES"=>247,
"CURSERES"=>248,
"GRAVITYRES"=>249,
"SLOWRES"=>250,
"STUNRES"=>251,
"CHARMRES"=>252,
"AMNESIARES"=>253,
"LULLABYRES"=>254,
"DEATHRES"=>255,
"AFTERMATH"=>256,
"PARALYZE"=>257,
"MIJIN_GAKURE"=>258,
"DUAL_WIELD"=>259,
"DOUBLE_ATTACK"=>288,
"SUBTLE_BLOW"=>289,
"ENF_MAG_POTENCY"=>290, //IncreasesEnfeeblingmagicpotency%
"COUNTER"=>291,
"KICK_ATTACK"=>292,
"AFFLATUS_SOLACE"=>293,
"AFFLATUS_MISERY"=>294,
"CLEAR_MIND"=>295,
"CONSERVE_MP"=>296,
"ENHANCES_SABOTEUR"=>297, //IncreasesSaboteurPotency%
"STEAL"=>298,
"DESPOIL"=>896,
"PERFECT_DODGE"=>883, //IncreasesPerfectDodgedurationinseconds
"BLINK"=>299,
"STONESKIN"=>300,
"PHALANX"=>301,
"TRIPLE_ATTACK"=>302,
"TREASURE_HUNTER"=>303,
"TAME"=>304,
"RECYCLE"=>305,
"ZANSHIN"=>306,
"UTSUSEMI"=>307,
"UTSUSEMI_BONUS"=>900, //Extrashadowsfromgear
"NINJA_TOOL"=>308,
"BLUE_POINTS"=>309,
"DMG_REFLECT"=>316,
"ROLL_ROGUES"=>317,
"ROLL_GALLANTS"=>318,
"ROLL_CHAOS"=>319,
"ROLL_BEAST"=>320,
"ROLL_CHORAL"=>321,
"ROLL_HUNTERS"=>322,
"ROLL_SAMURAI"=>323,
"ROLL_NINJA"=>324,
"ROLL_DRACHEN"=>325,
"ROLL_EVOKERS"=>326,
"ROLL_MAGUS"=>327,
"ROLL_CORSAIRS"=>328,
"ROLL_PUPPET"=>329,
"ROLL_DANCERS"=>330,
"ROLL_SCHOLARS"=>331,
//CorsairRollsLevel65+
"ROLL_BOLTERS"=>869,
"ROLL_CASTERS"=>870,
"ROLL_COURSERS"=>871,
"ROLL_BLITZERS"=>872,
"ROLL_TACTICIANS"=>873,
"ROLL_ALLIES"=>874,
"ROLL_MISERS"=>875,
"ROLL_COMPANIONS"=>876,
"ROLL_AVENGERS"=>877,
"ROLL_NATURALISTS"=>878,
"ROLL_RUNEISTS"=>879,
"BUST"=>332,
"FINISHING_MOVES"=>333,
"SAMBA_DURATION"=>490, //Sambadurationbonus
"WALTZ_POTENTCY"=>491, //WaltzPotentcyBonus
"JIG_DURATION"=>492, //Jigdurationbonusinpercents
"VFLOURISH_MACC"=>493, //ViolentFlourishaccuracybonus
"STEP_FINISH"=>494, //Bonusfinishingmovesfromsteps
"STEP_ACCURACY"=>403, //Accuracybonusforsteps
"WALTZ_DELAY"=>497, //WaltzAbilityDelaymodifier(-1modis-1second)
"SAMBA_PDURATION"=>498, //Sambapercentdurationbonus
"WIDESCAN"=>340,
"BARRAGE_ACC"=>420,
"ENSPELL"=>341,
"SPIKES"=>342,
"ENSPELL_DMG"=>343,
"ENSPELL_CHANCE"=>856,
"SPIKES_DMG"=>344,
"TP_BONUS"=>345,
"PERPETUATION_REDUCTION"=>346,
"FIRE_AFFINITY_DMG"=>347,
"EARTH_AFFINITY_DMG"=>348,
"WATER_AFFINITY_DMG"=>349,
"ICE_AFFINITY_DMG"=>350,
"THUNDER_AFFINITY_DMG"=>351,
"WIND_AFFINITY_DMG"=>352,
"LIGHT_AFFINITY_DMG"=>353,
"DARK_AFFINITY_DMG"=>354,
"FIRE_AFFINITY_ACC"=>544,
"EARTH_AFFINITY_ACC"=>545,
"WATER_AFFINITY_ACC"=>546,
"ICE_AFFINITY_ACC"=>547,
"THUNDER_AFFINITY_ACC"=>548,
"WIND_AFFINITY_ACC"=>549,
"LIGHT_AFFINITY_ACC"=>550,
"DARK_AFFINITY_ACC"=>551,
"FIRE_AFFINITY_PERP"=>553,
"EARTH_AFFINITY_PERP"=>554,
"WATER_AFFINITY_PERP"=>555,
"ICE_AFFINITY_PERP"=>556,
"THUNDER_AFFINITY_PERP"=>557,
"WIND_AFFINITY_PERP"=>558,
"LIGHT_AFFINITY_PERP"=>559,
"DARK_AFFINITY_PERP"=>560,
"ADDS_WEAPONSKILL"=>355,
"ADDS_WEAPONSKILL_DYN"=>356,
"BP_DELAY"=>357,
"STEALTH"=>358,
"RAPID_SHOT"=>359,
"CHARM_TIME"=>360,
"JUMP_TP_BONUS"=>361,
"JUMP_ATT_BONUS"=>362,
"HIGH_JUMP_ENMITY_REDUCTION"=>363,
"REWARD_HP_BONUS"=>364,
"SNAP_SHOT"=>365,
"MAIN_DMG_RATING"=>366,
"SUB_DMG_RATING"=>367,
"REGAIN"=>368,
"REFRESH"=>369,
"REGEN"=>370,
"AVATAR_PERPETUATION"=>371,
"WEATHER_REDUCTION"=>372,
"DAY_REDUCTION"=>373,
"CURE_POTENCY"=>374,
"CURE_POTENCY_II"=>260, //%curepotencyII|bonusfromgeariscappedat30
"CURE_POTENCY_RCVD"=>375,
"RANGED_DMG_RATING"=>376,
"DELAYP"=>380,
"RANGED_DELAYP"=>381,
"EXP_BONUS"=>382,
"HASTE_ABILITY"=>383,
"HASTE_GEAR"=>384,
"SHIELD_BASH"=>385,
"KICK_DMG"=>386,
"CHARM_CHANCE"=>391,
"WEAPON_BASH"=>392,
"BLACK_MAGIC_COST"=>393,
"WHITE_MAGIC_COST"=>394,
"BLACK_MAGIC_CAST"=>395,
"WHITE_MAGIC_CAST"=>396,
"BLACK_MAGIC_RECAST"=>397,
"WHITE_MAGIC_RECAST"=>398,
"ALACRITY_CELERITY_EFFECT"=>399,
"LIGHT_ARTS_EFFECT"=>334,
"DARK_ARTS_EFFECT"=>335,
"LIGHT_ARTS_SKILL"=>336,
"DARK_ARTS_SKILL"=>337,
"LIGHT_ARTS_REGEN"=>338, //RegenbonusHPfromLightArtsandTabulaRasa
"REGEN_DURATION"=>339,
"HELIX_EFFECT"=>478,
"HELIX_DURATION"=>477,
"STORMSURGE_EFFECT"=>400,
"SUBLIMATION_BONUS"=>401,
"GRIMOIRE_SPELLCASTING"=>489, //"Grimoire:Reducesspellcastingtime"bonus
"WYVERN_BREATH"=>402,
"REGEN_DOWN"=>404, //poison
"REFRESH_DOWN"=>405, //plague,reducemp
"REGAIN_DOWN"=>406, //plague,reducetp
"MAGIC_DAMAGE"=>311, //Magicdamageaddeddirectlytothespell'sbasedamage

//Gearsetmodifiers
"DA_DOUBLE_DAMAGE"=>408, //Doubleattack'sdoubledamagechance%.
"TA_TRIPLE_DAMAGE"=>409, //Tripleattack'stripledamagechance%.
"ZANSHIN_DOUBLE_DAMAGE"=>410, //Zanshin'sdoubledamagechance%.
"RAPID_SHOT_DOUBLE_DAMAGE"=>479, //Rapidshot'sdoubledamagechance%.
"ABSORB_DMG_CHANCE"=>480, //Chancetoabsorbdamage%
"EXTRA_DUAL_WIELD_ATTACK"=>481, //Chancetolandanextraattackwhendualwielding
"EXTRA_KICK_ATTACK"=>482, //OccasionallyallowsasecondKickAttackduringanattackroundwithouttheuseofFootwork.
"SAMBA_DOUBLE_DAMAGE"=>415, //Doubledamagechancewhensambaisup.
"NULL_PHYSICAL_DAMAGE"=>416, //Occasionallyannulsdamagefromphysicalattacks,inpercents
"QUICK_DRAW_TRIPLE_DAMAGE"=>417, //Chancetodotripledamagewithquickdraw.
"BAR_ELEMENT_NULL_CHANCE"=>418, //BarElementalspellswilloccasionallynullifydamageofthesameelement.
"GRIMOIRE_INSTANT_CAST"=>419, //SpellsthatmatchyourcurrentArtswilloccasionallycastinstantly,withoutrecast.
"COUNTERSTANCE_EFFECT"=>543, //Counterstanceeffectinpercents
"DODGE_EFFECT"=>552, //Dodgeeffectinpercents
"FOCUS_EFFECT"=>561, //Focuseffectinpercents
"MUG_EFFECT"=>835, //Mugeffectasmultiplier
"ACC_COLLAB_EFFECT"=>884, //Increasesamountofenmitytransferred
"HIDE_DURATION"=>885, //Hidedurationincrease(percentagebased
"GILFINDER"=>897, //Gil%increase
"REVERSE_FLOURISH_EFFECT"=>836, //ReverseFlourisheffectintenthsofsquaredtermmultiplier
"SENTINEL_EFFECT"=>837, //Sentineleffectinpercents
"REGEN_MULTIPLIER"=>838, //Regenbasemultiplier

"DOUBLE_SHOT_RATE"=>422, //Theratethatdoubleshotcanproc
"VELOCITY_SNAPSHOT_BONUS"=>423, //IncreasesSnapshotwhilstVelocityShotisup.
"VELOCITY_RATT_BONUS"=>424, //IncreasesRangedAttackwhilstVelocityShotisup.
"SHADOW_BIND_EXT"=>425, //Extendsthetimeofshadowbind
"ABSORB_PHYSDMG_TO_MP"=>426, //AbsorbsapercentageofphysicaldamagetakentoMP.
"ENMITY_REDUCTION_PHYSICAL"=>427, //ReducesEnmitydecreasewhentakingphysicaldamage
"SHIELD_MASTERY_TP"=>485, //ShieldmasteryTPbonuswhenblockingwithashield
"PERFECT_COUNTER_ATT"=>428, //Raisesweapondamageby20whencounteringwhileunderthePerfectCountereffects.ThisalsoaffectsWeaponRank(thoughnotiffightingbarehanded).
"FOOTWORK_ATT_BONUS"=>429, //RaisestheattackbonusofFootwork.(TantraGaiters+2raise100/1024to152/1024)

"MINNE_EFFECT"=>433, //
"MINUET_EFFECT"=>434, //
"PAEON_EFFECT"=>435, //
"REQUIEM_EFFECT"=>436, //
"THRENODY_EFFECT"=>437, //
"MADRIGAL_EFFECT"=>438, //
"MAMBO_EFFECT"=>439, //
"LULLABY_EFFECT"=>440, //
"ETUDE_EFFECT"=>441, //
"BALLAD_EFFECT"=>442, //
"MARCH_EFFECT"=>443, //
"FINALE_EFFECT"=>444, //
"CAROL_EFFECT"=>445, //
"MAZURKA_EFFECT"=>446, //
"ELEGY_EFFECT"=>447, //
"PRELUDE_EFFECT"=>448, //
"HYMNUS_EFFECT"=>449, //
"VIRELAI_EFFECT"=>450, //
"SCHERZO_EFFECT"=>451, //
"ALL_SONGS_EFFECT"=>452, //
"MAXIMUM_SONGS_BONUS"=>453, //
"SONG_DURATION_BONUS"=>454, //
"SONG_SPELLCASTING_TIME"=>455, //

"QUICK_DRAW_DMG"=>411, //
"QUAD_ATTACK"=>430, //Quadrupleattackchance.

"ADDITIONAL_EFFECT"=>431, //Alladditionaleffects
"ENSPELL_DMG_BONUS"=>432,

"FIRE_ABSORB"=>459, //Occasionallyabsorbsfireelementaldamage,inpercents
"EARTH_ABSORB"=>460, //Occasionallyabsorbsearthelementaldamage,inpercents
"WATER_ABSORB"=>461, //Occasionallyabsorbswaterelementaldamage,inpercents
"WIND_ABSORB"=>462, //Occasionallyabsorbswindelementaldamage,inpercents
"ICE_ABSORB"=>463, //Occasionallyabsorbsiceelementaldamage,inpercents
"LTNG_ABSORB"=>464, //Occasionallyabsorbsthunderelementaldamage,inpercents
"LIGHT_ABSORB"=>465, //Occasionallyabsorbslightelementaldamage,inpercents
"DARK_ABSORB"=>466, //Occasionallyabsorbsdarkelementaldamage,inpercents

"FIRE_NULL"=>467, //
"EARTH_NULL"=>468, //
"WATER_NULL"=>469, //
"WIND_NULL"=>470, //
"ICE_NULL"=>471, //
"LTNG_NULL"=>472, //
"LIGHT_NULL"=>473, //
"DARK_NULL"=>474, //

"MAGIC_ABSORB"=>475, //Occasionallyabsorbsmagicdamagetaken,inpercents
"MAGIC_NULL"=>476, //Occasionallyannulsmagicdamagetaken,inpercents
"PHYS_ABSORB"=>512, //Occasionallyabsorbsphysicaldamagetaken,inpercents
"ABSORB_DMG_TO_MP"=>516, //UnlikePLDgearmod,worksonalldamagetypes(EtherealEarring)

"WARCRY_DURATION"=>483, //Warcydurationbonusfromgear
"AUSPICE_EFFECT"=>484, //AuspiceSubtleBlowBonus
"TACTICAL_PARRY"=>486, //TacticalParryTPBonus
"MAG_BURST_BONUS"=>487, //MagicBurstBonus
"INHIBIT_TP"=>488, //InhibitsTPGain(percent)

"GOV_CLEARS"=>496, //TracksGoVpagecompletion(for4%bonusonrewards).

//Reraise(AutoReraise,willbeusedbyATMA)
"RERAISE_I"=>456, //Reraise.
"RERAISE_II"=>457, //ReraiseII.
"RERAISE_III"=>458, //ReraiseIII.

"ITEM_SPIKES_TYPE"=>499, //Typespikesanitemhas
"ITEM_SPIKES_DMG"=>500, //Damageofanitemsspikes
"ITEM_SPIKES_CHANCE"=>501, //Chanceofanitemsspikeproc

"FERAL_HOWL_DURATION"=>503, //+20%durationpermeritwhenwearingaugmentedMonsterJackcoat+2
"MANEUVER_BONUS"=>504, //ManeuverStatBonus
"OVERLOAD_THRESH"=>505, //OverloadThresholdBonus
"BURDEN_DECAY"=>847, //Increasesamountofburdenremovedpertick
"REPAIR_EFFECT"=>853, //Removes#ofstatuseffectsfromtheAutomaton
"REPAIR_POTENCY"=>854, //Note:Onlyaffectsamountregeneratedbya%,nottheinstantrestore!
"PREVENT_OVERLOAD"=>855, //Overloadingerasesawatermaneuver(exceptonwateroverloads)instead,ifthereisone
"EXTRA_DMG_CHANCE"=>506, //ProcrateofOCC_DO_EXTRA_DMG.111wouldbe11.1%
"OCC_DO_EXTRA_DMG"=>507, //Multiplierfor"Occasionallydoxtimesnormaldamage".250wouldbe2.5timesdamage.

"REM_OCC_DO_DOUBLE_DMG"=>863, //ProcrateforREMAftermathsthatapply"Occasionallydodoubledamage"
"REM_OCC_DO_TRIPLE_DMG"=>864, //ProcrateforREMAftermathsthatapply"Occasionallydotripledamage"

"REM_OCC_DO_DOUBLE_DMG_RANGED"=>867, //Rangedattackspecific
"REM_OCC_DO_TRIPLE_DMG_RANGED"=>868, //Rangedattackspecific

"MYTHIC_OCC_ATT_TWICE"=>865, //Procratefor"Occasionallyattackstwice"
"MYTHIC_OCC_ATT_THRICE"=>866, //Procratefor"Occasionallyattacksthrice"

"EAT_RAW_FISH"=>412, //
"EAT_RAW_MEAT"=>413, //

"ENHANCES_CURSNA_RCVD"=>67, //Potencyof"Cursna"effectsreceived
"ENHANCES_CURSNA"=>310, //RaisessuccessrateofCursnawhenremovingeffect(likeDoom)thatarenot100%chancetoremove
"ENHANCES_HOLYWATER"=>495, //Usedbygearwiththe"EnhancesHolyWater"or"HolyWater+"attribute

"RETALIATION"=>414, //IncreasesdamageofRetaliationhits
"THIRD_EYE_COUNTER_RATE"=>508, //Addscounterto3rdeyeanticipates&ifusingSeigancounterrateisincreasedby15%
"THIRD_EYE_ANTICIPATE_RATE"=>839, //Addsanticipaterateinpercents

"CLAMMING_IMPROVED_RESULTS"=>509, //
"CLAMMING_REDUCED_INCIDENTS"=>510, //
"CHOCOBO_RIDING_TIME"=>511, //Increaseschocoboridingtime
"HARVESTING_RESULT"=>513, //Improvesharvestingresults
"LOGGING_RESULT"=>514, //Improvesloggingresults
"MINING_RESULT"=>515, //Improvesminingresults
"EGGHELM"=>517, //EggHelm(ChocoboDigging)

"SHIELDBLOCKRATE"=>518, //Affectsshieldblockrate,percentbased
"SCAVENGE_EFFECT"=>312, //
"DIA_DOT"=>313, //IncreasestheDoTdamageofDia
"SHARPSHOT"=>314, //Sharpshotaccuracybonus
"ENH_DRAIN_ASPIR"=>315, //%damageboosttoDrainandAspir
"SNEAK_ATK_DEX"=>874, //%DEXboosttoSneakAttack(ifgearmod,needstobeequippedonhit)
"TRICK_ATK_AGI"=>520, //%AGIboosttoTrickAttack(ifgearmod,needstobeequippedonhit)
"NIN_NUKE_BONUS"=>522, //magicattackbonusforNINnukes
"DAKEN"=>911, //Chancetothrowshurikenonattack
"AMMO_SWING"=>523, //Extraswingratew/ammo(ie.Jailerweapons).Usegearsets,anddoesnothingfornon-players.
"AMMO_SWING_TYPE"=>826, //Forthehandednessoftheweapon-1h(1)vs.2h/h2h(2).h2hcansafelyusethesamefunctionas2h.
"ROLL_RANGE"=>528, //AdditionalrangeforCORrollabilities.
"PHANTOM_ROLL"=>881, //PhantomRoll+EffectfromSOARings.
"PHANTOM_DURATION"=>882, //PhantomRollDuration+.

"ENHANCES_REFRESH"=>529, //"EnhancesRefresh"adds+1permodifiertospell'stickresult.
"NO_SPELL_MP_DEPLETION"=>530, //%tonotdepleteMPonspellcast.
"FORCE_FIRE_DWBONUS"=>531, //Setto1toforcefireday/weatherspellbonus/penalty.Donothaveittotalmorethan1.
"FORCE_EARTH_DWBONUS"=>532, //Setto1toforceearthday/weatherspellbonus/penalty.Donothaveittotalmorethan1.
"FORCE_WATER_DWBONUS"=>533, //Setto1toforcewaterday/weatherspellbonus/penalty.Donothaveittotalmorethan1.
"FORCE_WIND_DWBONUS"=>534, //Setto1toforcewindday/weatherspellbonus/penalty.Donothaveittotalmorethan1.
"FORCE_ICE_DWBONUS"=>535, //Setto1toforceiceday/weatherspellbonus/penalty.Donothaveittotalmorethan1.
"FORCE_LIGHTNING_DWBONUS"=>536, //Setto1toforcelightningday/weatherspellbonus/penalty.Donothaveittotalmorethan1.
"FORCE_LIGHT_DWBONUS"=>537, //Setto1toforcelightday/weatherspellbonus/penalty.Donothaveittotalmorethan1.
"FORCE_DARK_DWBONUS"=>538, //Setto1toforcedarkday/weatherspellbonus/penalty.Donothaveittotalmorethan1.
"STONESKIN_BONUS_HP"=>539, //Bonus"HP"grantedtoStoneskinspell.
"ENHANCES_ELEMENTAL_SIPHON"=>540, //BonusBaseMPaddedtoElementalSiphonskill.
"BP_DELAY_II"=>541, //BloodPactDelayReductionII
"JOB_BONUS_CHANCE"=>542, //ChancetoapplyjobbonustoCORrollwithouthavingthejobintheparty.
"DAY_NUKE_BONUS"=>565, //Bonusdamagefrom"Elementalmagicaffectedbyday"(Sorc.Tonban)
"IRIDESCENCE"=>566, //Iridescencetrait(additionalweatherdamage/penalty)
"BARSPELL_AMOUNT"=>567, //Additionalelementalresistancegrantedbybar-spells
"BARSPELL_MDEF_BONUS"=>827, //Extramagicdefensebonusgrantedtothebar-spelleffect
"RAPTURE_AMOUNT"=>568, //BonusamountaddedtoRaptureeffect
"EBULLIENCE_AMOUNT"=>569, //BonusamountaddedtoEbullienceeffect
"WYVERN_EFFECTIVE_BREATH"=>829, //Increasesthethresholdfortriggeringhealingbreath
"AQUAVEIL_COUNT"=>832, //ModifiestheamountofhitsthatAquaveilabsorbsbeforebeingremoved
"SONG_RECAST_DELAY"=>833, //Reducessongrecasttimeinseconds.
"ENH_MAGIC_DURATION"=>890, //EnhancingMagicDurationincrease%
"ENHANCES_COURSERS_ROLL"=>891, //Courser'sRollBonus%chance
"ENHANCES_CASTERS_ROLL"=>892, //Caster'sRollBonus%chance
"ENHANCES_BLITZERS_ROLL"=>893, //Blitzer'sRollBonus%chance
"ENHANCES_ALLIES_ROLL"=>894, //Allies'RollBonus%chance
"ENHANCES_TACTICIANS_ROLL"=>895, //Tactician'sRollBonus%chance
"OCCULT_ACUMEN"=>902, //GrantsbonusTPwhendealingdamagewithelementalordarkmagic

"QUICK_MAGIC"=>909, //Percentchancespellscastinstantly(alsoreducesrecastto0,similartoChainspell)

//Automatonmods
"AUTO_DECISION_DELAY"=>842, //ReducestheAutomaton'sglobaldecisiondelay
"AUTO_SHIELD_BASH_DELAY"=>843, //ReducestheAutomaton'sglobalshieldbashdelay
"AUTO_MAGIC_DELAY"=>844, //ReducestheAutomaton'sglobalmagicdelay
"AUTO_HEALING_DELAY"=>845, //ReducestheAutomaton'sglobalhealingdelay
"AUTO_HEALING_THRESHOLD"=>846, //Increasesthehealingtriggerthreshold
"AUTO_SHIELD_BASH_SLOW"=>848, //AddsasloweffecttoShieldBash
"AUTO_TP_EFFICIENCY"=>849, //CausestheAutomatontowaittoformaskillchainwhenitsmasteris>90%TP
"AUTO_SCAN_RESISTS"=>850, //CausestheAutomatontoscanatarget'sresistances

//MythicWeaponMods
"AUGMENTS_ABSORB"=>521, //DirectAbsorbspellincreasewhileLiberatorisequipped(percentagebased)
"AOE_NA"=>524, //Setto1tomake-naspells/erasealwaysAoEw/DivineVeil
"AUGMENTS_CONVERT"=>525, //ConvertHPtoMPRatioMultiplier.Value=>MPmultiplierrate.
"AUGMENTS_SA"=>526, //AddsCriticalAttackBonustoSneakAttack,percentagebased.
"AUGMENTS_TA"=>527, //AddsCriticalAttackBonustoTrickAttack,percentagebased.
"AUGMENTS_FEINT"=>873, //Feintwillgiveanother-10Evasionpermeritlevel
"AUGMENTS_ASSASSINS_CHARGE"=>886, //GivesAssassin'sCharge+1%CriticalHitRatepermeritlevel
"AUGMENTS_AMBUSH"=>887, //Gives+1%TripleAttackpermeritlevelwhenAmbushconditionsaremet
"AUGMENTS_AURA_STEAL"=>889, //20%chanceof2effectstobedispelledorstolenpermeritlevel
"AUGMENTS_CONSPIRATOR"=>912, //AppliesConspiratorbenefitstoplayeratthetopofthehatelist
"JUG_LEVEL_RANGE"=>564, //Decreasesthelevelrangeofspawnedjugpets.Maxesoutat2.
"FORCE_JUMP_CRIT"=>828, //Criticalhitratebonusforjumpandhighjump
"QUICK_DRAW_DMG_PERCENT"=>834, //PercentageincreasetoQDdamage

//Craftingfoodeffects
"SYNTH_SUCCESS"=>851, //Rateofsynthesissuccess
"SYNTH_SKILL_GAIN"=>852, //Synthesisskillgainrate
"SYNTH_FAIL_RATE"=>861, //Synthesisfailurerate(percent)
"SYNTH_HQ_RATE"=>862, //High-qualitysuccessrate(notapercent)

"WEAPONSKILL_DAMAGE_BASE"=>570, //Specificto1Weaponskill:Seemodifier.hforhowthisisused
"ALL_WSDMG_ALL_HITS"=>840, //Generic(allWeaponskills)damage,onallhits.
//Perhttps://www.bg-wiki.com/bg/Weapon_Skill_Damageweneedall3..
"ALL_WSDMG_FIRST_HIT"=>841, //Generic(allWeaponskills)damage,firsthitonly.
"WS_NO_DEPLETE"=>949,

//CircleAbilitiesExtendedDurationfromAF/AF+1
"HOLY_CIRCLE_DURATION"=>857,
"ARCANE_CIRCLE_DURATION"=>858,
"ANCIENT_CIRCLE_DURATION"=>859,

//Other
"CURE2MP_PERCENT"=>860, //Converts%of"Cure"amounttoMP
"DIVINE_BENISON"=>910, //Addsfastcastandenmityreductionto-Naspells(includesErase).Enmityreductionishalfofthefastcastamount
"SAVETP"=>880, //SAVETPEffectforMiser'sRoll/ATMA/Hagakure.
"SMITE"=>898, //AttincreasewithH2Hor2Hweapons
"TACTICAL_GUARD"=>899, //Tpgainincreasewhenguarding
"FENCER_TP_BONUS"=>903, //TPBonustoweaponskillsfromFencerTrait
"FENCER_CRITHITRATE"=>904, //IncreasedCritchancefromFencerTrait
"SHIELD_DEF_BONUS"=>905, //ShieldDefenseBonus
);
$mod_name=array_flip($mods);


$bit_array = array(
1=>"1",
2=>"2",
4=>"3",
8=>"4",
16=>"5",
32=>"6",
64=>"7",
128=>"8",
256=>"9",
512=>"10"
);

?>