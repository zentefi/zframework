<?php 

class HTMLPageDevelopToolIconsFontsAwesome extends HTMLPageDevelopToolIcons  {

	const URL_SCRIPT_PATTERN = '/icons\/fa(?:\.php)?';
	const THEME = 'fonts-awesome';

	const DEFAULT_CATEGORY = 'all';
	const CATEGORY_GET_VARNAME = 'c';

	/*----------------------------------------------*/

	protected static function _get_title()
	{
		return 'Icons Fonts Awesome';
	}
	
	protected static function _get_show_index()
	{
		return false;
	}
	
	/*----------------------------------------------*/
		
	public function __construct() {
		parent::__construct(self::THEME);
		self::add_global_static_library(self::STATIC_LIBRARY_FONTS_AWESOME);

		$this->_show_icon_block_button = true;
		$selected_category = $_GET[self::CATEGORY_GET_VARNAME];
		$categories = self::_get_icons();

		if(!$selected_category || !array_key_exists($selected_category, $categories)) {
			$selected_category = self::DEFAULT_CATEGORY;
		}

		$this->set_param('selected_category', $selected_category);
		$this->set_param('categories', $categories);

		$keys = array_keys($categories);
		array_unshift($keys, 'all');

		$this->set_param('keys', $keys);
		$this->set_param('key_varname', self::CATEGORY_GET_VARNAME);

	}
	
	public function prepare_params() {
		
		parent::prepare_params();
	}

	protected static function _get_icons()
	{
		return  array (
			'web-application-icons' =>
				array (
					'key' => 'web-application-icons',
					'title' => 'Web Application Icons',
					'icons' =>
						array (
							0 => 'adjust',
							1 => 'anchor',
							2 => 'archive',
							3 => 'area-chart',
							4 => 'arrows',
							5 => 'arrows-h',
							6 => 'arrows-v',
							7 => 'asterisk',
							8 => 'at',
							9 => 'automobile',
							10 => 'ban',
							11 => 'bank',
							12 => 'bar-chart',
							13 => 'bar-chart-o',
							14 => 'barcode',
							15 => 'bars',
							16 => 'bed',
							17 => 'beer',
							18 => 'bell',
							19 => 'bell-o',
							20 => 'bell-slash',
							21 => 'bell-slash-o',
							22 => 'bicycle',
							23 => 'binoculars',
							24 => 'birthday-cake',
							25 => 'bolt',
							26 => 'bomb',
							27 => 'book',
							28 => 'bookmark',
							29 => 'bookmark-o',
							30 => 'briefcase',
							31 => 'bug',
							32 => 'building',
							33 => 'building-o',
							34 => 'bullhorn',
							35 => 'bullseye',
							36 => 'bus',
							37 => 'cab',
							38 => 'calculator',
							39 => 'calendar',
							40 => 'calendar-o',
							41 => 'camera',
							42 => 'camera-retro',
							43 => 'car',
							44 => 'caret-square-o-down',
							45 => 'caret-square-o-left',
							46 => 'caret-square-o-right',
							47 => 'caret-square-o-up',
							48 => 'cart-arrow-down',
							49 => 'cart-plus',
							50 => 'cc',
							51 => 'certificate',
							52 => 'check',
							53 => 'check-circle',
							54 => 'check-circle-o',
							55 => 'check-square',
							56 => 'check-square-o',
							57 => 'child',
							58 => 'circle',
							59 => 'circle-o',
							60 => 'circle-o-notch',
							61 => 'circle-thin',
							62 => 'clock-o',
							63 => 'close',
							64 => 'cloud',
							65 => 'cloud-download',
							66 => 'cloud-upload',
							67 => 'code',
							68 => 'code-fork',
							69 => 'coffee',
							70 => 'cog',
							71 => 'cogs',
							72 => 'comment',
							73 => 'comment-o',
							74 => 'comments',
							75 => 'comments-o',
							76 => 'compass',
							77 => 'copyright',
							78 => 'credit-card',
							79 => 'crop',
							80 => 'crosshairs',
							81 => 'cube',
							82 => 'cubes',
							83 => 'cutlery',
							84 => 'dashboard',
							85 => 'database',
							86 => 'desktop',
							87 => 'diamond',
							88 => 'dot-circle-o',
							89 => 'download',
							90 => 'edit',
							91 => 'ellipsis-h',
							92 => 'ellipsis-v',
							93 => 'envelope',
							94 => 'envelope-o',
							95 => 'envelope-square',
							96 => 'eraser',
							97 => 'exchange',
							98 => 'exclamation',
							99 => 'exclamation-circle',
							100 => 'exclamation-triangle',
							101 => 'external-link',
							102 => 'external-link-square',
							103 => 'eye',
							104 => 'eye-slash',
							105 => 'eyedropper',
							106 => 'fax',
							107 => 'female',
							108 => 'fighter-jet',
							109 => 'file-archive-o',
							110 => 'file-audio-o',
							111 => 'file-code-o',
							112 => 'file-excel-o',
							113 => 'file-image-o',
							114 => 'file-movie-o',
							115 => 'file-pdf-o',
							116 => 'file-photo-o',
							117 => 'file-picture-o',
							118 => 'file-powerpoint-o',
							119 => 'file-sound-o',
							120 => 'file-video-o',
							121 => 'file-word-o',
							122 => 'file-zip-o',
							123 => 'film',
							124 => 'filter',
							125 => 'fire',
							126 => 'fire-extinguisher',
							127 => 'flag',
							128 => 'flag-checkered',
							129 => 'flag-o',
							130 => 'flash',
							131 => 'flask',
							132 => 'folder',
							133 => 'folder-o',
							134 => 'folder-open',
							135 => 'folder-open-o',
							136 => 'frown-o',
							137 => 'futbol-o',
							138 => 'gamepad',
							139 => 'gavel',
							140 => 'gear',
							141 => 'gears',
							142 => 'genderless',
							143 => 'gift',
							144 => 'glass',
							145 => 'globe',
							146 => 'graduation-cap',
							147 => 'group',
							148 => 'hdd-o',
							149 => 'headphones',
							150 => 'heart',
							151 => 'heart-o',
							152 => 'heartbeat',
							153 => 'history',
							154 => 'home',
							155 => 'hotel',
							156 => 'image',
							157 => 'inbox',
							158 => 'info',
							159 => 'info-circle',
							160 => 'institution',
							161 => 'key',
							162 => 'keyboard-o',
							163 => 'language',
							164 => 'laptop',
							165 => 'leaf',
							166 => 'legal',
							167 => 'lemon-o',
							168 => 'level-down',
							169 => 'level-up',
							170 => 'life-bouy',
							171 => 'life-buoy',
							172 => 'life-ring',
							173 => 'life-saver',
							174 => 'lightbulb-o',
							175 => 'line-chart',
							176 => 'location-arrow',
							177 => 'lock',
							178 => 'magic',
							179 => 'magnet',
							180 => 'mail-forward',
							181 => 'mail-reply',
							182 => 'mail-reply-all',
							183 => 'male',
							184 => 'map-marker',
							185 => 'meh-o',
							186 => 'microphone',
							187 => 'microphone-slash',
							188 => 'minus',
							189 => 'minus-circle',
							190 => 'minus-square',
							191 => 'minus-square-o',
							192 => 'mobile',
							193 => 'mobile-phone',
							194 => 'money',
							195 => 'moon-o',
							196 => 'mortar-board',
							197 => 'motorcycle',
							198 => 'music',
							199 => 'navicon',
							200 => 'newspaper-o',
							201 => 'paint-brush',
							202 => 'paper-plane',
							203 => 'paper-plane-o',
							204 => 'paw',
							205 => 'pencil',
							206 => 'pencil-square',
							207 => 'pencil-square-o',
							208 => 'phone',
							209 => 'phone-square',
							210 => 'photo',
							211 => 'picture-o',
							212 => 'pie-chart',
							213 => 'plane',
							214 => 'plug',
							215 => 'plus',
							216 => 'plus-circle',
							217 => 'plus-square',
							218 => 'plus-square-o',
							219 => 'power-off',
							220 => 'print',
							221 => 'puzzle-piece',
							222 => 'qrcode',
							223 => 'question',
							224 => 'question-circle',
							225 => 'quote-left',
							226 => 'quote-right',
							227 => 'random',
							228 => 'recycle',
							229 => 'refresh',
							230 => 'remove',
							231 => 'reorder',
							232 => 'reply',
							233 => 'reply-all',
							234 => 'retweet',
							235 => 'road',
							236 => 'rocket',
							237 => 'rss',
							238 => 'rss-square',
							239 => 'search',
							240 => 'search-minus',
							241 => 'search-plus',
							242 => 'send',
							243 => 'send-o',
							244 => 'server',
							245 => 'share',
							246 => 'share-alt',
							247 => 'share-alt-square',
							248 => 'share-square',
							249 => 'share-square-o',
							250 => 'shield',
							251 => 'ship',
							252 => 'shopping-cart',
							253 => 'sign-in',
							254 => 'sign-out',
							255 => 'signal',
							256 => 'sitemap',
							257 => 'sliders',
							258 => 'smile-o',
							259 => 'soccer-ball-o',
							260 => 'sort',
							261 => 'sort-alpha-asc',
							262 => 'sort-alpha-desc',
							263 => 'sort-amount-asc',
							264 => 'sort-amount-desc',
							265 => 'sort-asc',
							266 => 'sort-desc',
							267 => 'sort-down',
							268 => 'sort-numeric-asc',
							269 => 'sort-numeric-desc',
							270 => 'sort-up',
							271 => 'space-shuttle',
							272 => 'spinner',
							273 => 'spoon',
							274 => 'square',
							275 => 'square-o',
							276 => 'star',
							277 => 'star-half',
							278 => 'star-half-empty',
							279 => 'star-half-full',
							280 => 'star-half-o',
							281 => 'star-o',
							282 => 'street-view',
							283 => 'suitcase',
							284 => 'sun-o',
							285 => 'support',
							286 => 'tablet',
							287 => 'tachometer',
							288 => 'tag',
							289 => 'tags',
							290 => 'tasks',
							291 => 'taxi',
							292 => 'terminal',
							293 => 'thumb-tack',
							294 => 'thumbs-down',
							295 => 'thumbs-o-down',
							296 => 'thumbs-o-up',
							297 => 'thumbs-up',
							298 => 'ticket',
							299 => 'times',
							300 => 'times-circle',
							301 => 'times-circle-o',
							302 => 'tint',
							303 => 'toggle-down',
							304 => 'toggle-left',
							305 => 'toggle-off',
							306 => 'toggle-on',
							307 => 'toggle-right',
							308 => 'toggle-up',
							309 => 'trash',
							310 => 'trash-o',
							311 => 'tree',
							312 => 'trophy',
							313 => 'truck',
							314 => 'tty',
							315 => 'umbrella',
							316 => 'university',
							317 => 'unlock',
							318 => 'unlock-alt',
							319 => 'unsorted',
							320 => 'upload',
							321 => 'user',
							322 => 'user-plus',
							323 => 'user-secret',
							324 => 'user-times',
							325 => 'users',
							326 => 'video-camera',
							327 => 'volume-down',
							328 => 'volume-off',
							329 => 'volume-up',
							330 => 'warning',
							331 => 'wheelchair',
							332 => 'wifi',
							333 => 'wrench',
						),
				),
			'transportation-icons' =>
				array (
					'key' => 'transportation-icons',
					'title' => 'Transportation Icons',
					'icons' =>
						array (
							0 => 'ambulance',
							1 => 'automobile',
							2 => 'bicycle',
							3 => 'bus',
							4 => 'cab',
							5 => 'car',
							6 => 'fighter-jet',
							7 => 'motorcycle',
							8 => 'plane',
							9 => 'rocket',
							10 => 'ship',
							11 => 'space-shuttle',
							12 => 'subway',
							13 => 'taxi',
							14 => 'train',
							15 => 'truck',
							16 => 'wheelchair',
						),
				),
			'gender-icons' =>
				array (
					'key' => 'gender-icons',
					'title' => 'Gender Icons',
					'icons' =>
						array (
							0 => 'circle-thin',
							1 => 'genderless',
							2 => 'mars',
							3 => 'mars-double',
							4 => 'mars-stroke',
							5 => 'mars-stroke-h',
							6 => 'mars-stroke-v',
							7 => 'mercury',
							8 => 'neuter',
							9 => 'transgender',
							10 => 'transgender-alt',
							11 => 'venus',
							12 => 'venus-double',
							13 => 'venus-mars',
						),
				),
			'file-type-icons' =>
				array (
					'key' => 'file-type-icons',
					'title' => 'File Type Icons',
					'icons' =>
						array (
							0 => 'file',
							1 => 'file-archive-o',
							2 => 'file-audio-o',
							3 => 'file-code-o',
							4 => 'file-excel-o',
							5 => 'file-image-o',
							6 => 'file-movie-o',
							7 => 'file-o',
							8 => 'file-pdf-o',
							9 => 'file-photo-o',
							10 => 'file-picture-o',
							11 => 'file-powerpoint-o',
							12 => 'file-sound-o',
							13 => 'file-text',
							14 => 'file-text-o',
							15 => 'file-video-o',
							16 => 'file-word-o',
							17 => 'file-zip-o',
						),
				),
			'spinner-icons' =>
				array (
					'key' => 'spinner-icons',
					'title' => 'Spinner Icons',
					'icons' =>
						array (
							0 => 'circle-o-notch',
							1 => 'cog',
							2 => 'gear',
							3 => 'refresh',
							4 => 'spinner',
							5 => 'circle-o-notch fa-spin',
							6 => 'cog fa-spin',
							7 => 'gear fa-spin',
							8 => 'refresh fa-spin',
							9 => 'spinner fa-spin',
						),
				),
			'form-control-icons' =>
				array (
					'key' => 'form-control-icons',
					'title' => 'Form Control Icons',
					'icons' =>
						array (
							0 => 'check-square',
							1 => 'check-square-o',
							2 => 'circle',
							3 => 'circle-o',
							4 => 'dot-circle-o',
							5 => 'minus-square',
							6 => 'minus-square-o',
							7 => 'plus-square',
							8 => 'plus-square-o',
							9 => 'square',
							10 => 'square-o',
						),
				),
			'payment-icons' =>
				array (
					'key' => 'payment-icons',
					'title' => 'Payment Icons',
					'icons' =>
						array (
							0 => 'cc-amex',
							1 => 'cc-discover',
							2 => 'cc-mastercard',
							3 => 'cc-paypal',
							4 => 'cc-stripe',
							5 => 'cc-visa',
							6 => 'credit-card',
							7 => 'google-wallet',
							8 => 'paypal',
						),
				),
			'chart-icons' =>
				array (
					'key' => 'chart-icons',
					'title' => 'Chart Icons',
					'icons' =>
						array (
							0 => 'area-chart',
							1 => 'bar-chart',
							2 => 'bar-chart-o',
							3 => 'line-chart',
							4 => 'pie-chart',
						),
				),
			'currency-icons' =>
				array (
					'key' => 'currency-icons',
					'title' => 'Currency Icons',
					'icons' =>
						array (
							0 => 'bitcoin',
							1 => 'btc',
							2 => 'cny',
							3 => 'dollar',
							4 => 'eur',
							5 => 'euro',
							6 => 'gbp',
							7 => 'ils',
							8 => 'inr',
							9 => 'jpy',
							10 => 'krw',
							11 => 'money',
							12 => 'rmb',
							13 => 'rouble',
							14 => 'rub',
							15 => 'ruble',
							16 => 'rupee',
							17 => 'shekel',
							18 => 'sheqel',
							19 => 'try',
							20 => 'turkish-lira',
							21 => 'usd',
							22 => 'won',
							23 => 'yen',
						),
				),
			'text-editor-icons' =>
				array (
					'key' => 'text-editor-icons',
					'title' => 'Text Editor Icons',
					'icons' =>
						array (
							0 => 'align-center',
							1 => 'align-justify',
							2 => 'align-left',
							3 => 'align-right',
							4 => 'bold',
							5 => 'chain',
							6 => 'chain-broken',
							7 => 'clipboard',
							8 => 'columns',
							9 => 'copy',
							10 => 'cut',
							11 => 'dedent',
							12 => 'eraser',
							13 => 'file',
							14 => 'file-o',
							15 => 'file-text',
							16 => 'file-text-o',
							17 => 'files-o',
							18 => 'floppy-o',
							19 => 'font',
							20 => 'header',
							21 => 'indent',
							22 => 'italic',
							23 => 'link',
							24 => 'list',
							25 => 'list-alt',
							26 => 'list-ol',
							27 => 'list-ul',
							28 => 'outdent',
							29 => 'paperclip',
							30 => 'paragraph',
							31 => 'paste',
							32 => 'repeat',
							33 => 'rotate-left',
							34 => 'rotate-right',
							35 => 'save',
							36 => 'scissors',
							37 => 'strikethrough',
							38 => 'subscript',
							39 => 'superscript',
							40 => 'table',
							41 => 'text-height',
							42 => 'text-width',
							43 => 'th',
							44 => 'th-large',
							45 => 'th-list',
							46 => 'underline',
							47 => 'undo',
							48 => 'unlink',
						),
				),
			'directional-icons' =>
				array (
					'key' => 'directional-icons',
					'title' => 'Directional Icons',
					'icons' =>
						array (
							0 => 'angle-double-down',
							1 => 'angle-double-left',
							2 => 'angle-double-right',
							3 => 'angle-double-up',
							4 => 'angle-down',
							5 => 'angle-left',
							6 => 'angle-right',
							7 => 'angle-up',
							8 => 'arrow-circle-down',
							9 => 'arrow-circle-left',
							10 => 'arrow-circle-o-down',
							11 => 'arrow-circle-o-left',
							12 => 'arrow-circle-o-right',
							13 => 'arrow-circle-o-up',
							14 => 'arrow-circle-right',
							15 => 'arrow-circle-up',
							16 => 'arrow-down',
							17 => 'arrow-left',
							18 => 'arrow-right',
							19 => 'arrow-up',
							20 => 'arrows',
							21 => 'arrows-alt',
							22 => 'arrows-h',
							23 => 'arrows-v',
							24 => 'caret-down',
							25 => 'caret-left',
							26 => 'caret-right',
							27 => 'caret-square-o-down',
							28 => 'caret-square-o-left',
							29 => 'caret-square-o-right',
							30 => 'caret-square-o-up',
							31 => 'caret-up',
							32 => 'chevron-circle-down',
							33 => 'chevron-circle-left',
							34 => 'chevron-circle-right',
							35 => 'chevron-circle-up',
							36 => 'chevron-down',
							37 => 'chevron-left',
							38 => 'chevron-right',
							39 => 'chevron-up',
							40 => 'hand-o-down',
							41 => 'hand-o-left',
							42 => 'hand-o-right',
							43 => 'hand-o-up',
							44 => 'long-arrow-down',
							45 => 'long-arrow-left',
							46 => 'long-arrow-right',
							47 => 'long-arrow-up',
							48 => 'toggle-down',
							49 => 'toggle-left',
							50 => 'toggle-right',
							51 => 'toggle-up',
						),
				),
			'video-player-icons' =>
				array (
					'key' => 'video-player-icons',
					'title' => 'Video Player Icons',
					'icons' =>
						array (
							0 => 'arrows-alt',
							1 => 'backward',
							2 => 'compress',
							3 => 'eject',
							4 => 'expand',
							5 => 'fast-backward',
							6 => 'fast-forward',
							7 => 'forward',
							8 => 'pause',
							9 => 'play',
							10 => 'play-circle',
							11 => 'play-circle-o',
							12 => 'step-backward',
							13 => 'step-forward',
							14 => 'stop',
							15 => 'youtube-play',
						),
				),
			'brand-icons' =>
				array (
					'key' => 'brand-icons',
					'title' => 'Brand Icons',
					'icons' =>
						array (
							0 => 'adn',
							1 => 'android',
							2 => 'angellist',
							3 => 'apple',
							4 => 'behance',
							5 => 'behance-square',
							6 => 'bitbucket',
							7 => 'bitbucket-square',
							8 => 'bitcoin',
							9 => 'btc',
							10 => 'buysellads',
							11 => 'cc-amex',
							12 => 'cc-discover',
							13 => 'cc-mastercard',
							14 => 'cc-paypal',
							15 => 'cc-stripe',
							16 => 'cc-visa',
							17 => 'codepen',
							18 => 'connectdevelop',
							19 => 'css3',
							20 => 'dashcube',
							21 => 'delicious',
							22 => 'deviantart',
							23 => 'digg',
							24 => 'dribbble',
							25 => 'dropbox',
							26 => 'drupal',
							27 => 'empire',
							28 => 'facebook',
							29 => 'facebook-f',
							30 => 'facebook-official',
							31 => 'facebook-square',
							32 => 'flickr',
							33 => 'forumbee',
							34 => 'foursquare',
							35 => 'ge',
							36 => 'git',
							37 => 'git-square',
							38 => 'github',
							39 => 'github-alt',
							40 => 'github-square',
							41 => 'gittip',
							42 => 'google',
							43 => 'google-plus',
							44 => 'google-plus-square',
							45 => 'google-wallet',
							46 => 'gratipay',
							47 => 'hacker-news',
							48 => 'html5',
							49 => 'instagram',
							50 => 'ioxhost',
							51 => 'joomla',
							52 => 'jsfiddle',
							53 => 'lastfm',
							54 => 'lastfm-square',
							55 => 'leanpub',
							56 => 'linkedin',
							57 => 'linkedin-square',
							58 => 'linux',
							59 => 'maxcdn',
							60 => 'meanpath',
							61 => 'medium',
							62 => 'openid',
							63 => 'pagelines',
							64 => 'paypal',
							65 => 'pied-piper',
							66 => 'pied-piper-alt',
							67 => 'pinterest',
							68 => 'pinterest-p',
							69 => 'pinterest-square',
							70 => 'qq',
							71 => 'ra',
							72 => 'rebel',
							73 => 'reddit',
							74 => 'reddit-square',
							75 => 'renren',
							76 => 'sellsy',
							77 => 'share-alt',
							78 => 'share-alt-square',
							79 => 'shirtsinbulk',
							80 => 'simplybuilt',
							81 => 'skyatlas',
							82 => 'skype',
							83 => 'slack',
							84 => 'slideshare',
							85 => 'soundcloud',
							86 => 'spotify',
							87 => 'stack-exchange',
							88 => 'stack-overflow',
							89 => 'steam',
							90 => 'steam-square',
							91 => 'stumbleupon',
							92 => 'stumbleupon-circle',
							93 => 'tencent-weibo',
							94 => 'trello',
							95 => 'tumblr',
							96 => 'tumblr-square',
							97 => 'twitch',
							98 => 'twitter',
							99 => 'twitter-square',
							100 => 'viacoin',
							101 => 'vimeo-square',
							102 => 'vine',
							103 => 'vk',
							104 => 'wechat',
							105 => 'weibo',
							106 => 'weixin',
							107 => 'whatsapp',
							108 => 'windows',
							109 => 'wordpress',
							110 => 'xing',
							111 => 'xing-square',
							112 => 'yahoo',
							113 => 'yelp',
							114 => 'youtube',
							115 => 'youtube-play',
							116 => 'youtube-square',
						),
				),
			'medical-icons' =>
				array (
					'key' => 'medical-icons',
					'title' => 'Medical Icons',
					'icons' =>
						array (
							0 => 'ambulance',
							1 => 'h-square',
							2 => 'heart',
							3 => 'heart-o',
							4 => 'heartbeat',
							5 => 'hospital-o',
							6 => 'medkit',
							7 => 'plus-square',
							8 => 'stethoscope',
							9 => 'user-md',
							10 => 'wheelchair',
						),
				),
		) ;
	}
}