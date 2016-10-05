<?php
namespace FairEdge\Modules\Shortcodes\Lib;

use FairEdge\Modules\Shortcodes\Accordion\Accordion;
use FairEdge\Modules\Shortcodes\AccordionTab\AccordionTab;
use FairEdge\Modules\Shortcodes\Blockquote\Blockquote;
use FairEdge\Modules\Shortcodes\BlogList\BlogList;
use FairEdge\Modules\Shortcodes\BlogSlider\BlogSlider;
use FairEdge\Modules\Shortcodes\Button\Button;
use FairEdge\Modules\Shortcodes\CallToAction\CallToAction;
use FairEdge\Modules\Shortcodes\Clients\Clients;
use FairEdge\Modules\Shortcodes\Client\Client;
use FairEdge\Modules\Shortcodes\Counter\Countdown;
use FairEdge\Modules\Shortcodes\Counter\Counter;
use FairEdge\Modules\Shortcodes\CustomFont\CustomFont;
use FairEdge\Modules\Shortcodes\DevicePresentation\DevicePresentation;
use FairEdge\Modules\Shortcodes\Dropcaps\Dropcaps;
use FairEdge\Modules\Shortcodes\ElementsHolder\ElementsHolder;
use FairEdge\Modules\Shortcodes\ElementsHolderItem\ElementsHolderItem;
use FairEdge\Modules\Shortcodes\GoogleMap\GoogleMap;
use FairEdge\Modules\Shortcodes\Highlight\Highlight;
use FairEdge\Modules\Shortcodes\Icon\Icon;
use FairEdge\Modules\Shortcodes\IconListItem\IconListItem;
use FairEdge\Modules\Shortcodes\IconWithText\IconWithText;
use FairEdge\Modules\Shortcodes\ImageGallery\ImageGallery;
use FairEdge\Modules\Shortcodes\Message\Message;
use FairEdge\Modules\Shortcodes\OrderedList\OrderedList;
use FairEdge\Modules\Shortcodes\PieCharts\PieChartBasic\PieChartBasic;
use FairEdge\Modules\Shortcodes\PieCharts\PieChartDoughnut\PieChartDoughnut;
use FairEdge\Modules\Shortcodes\PieCharts\PieChartDoughnut\PieChartPie;
use FairEdge\Modules\Shortcodes\PieCharts\PieChartWithIcon\PieChartWithIcon;
use FairEdge\Modules\Shortcodes\PreviewSlide\PreviewSlide;
use FairEdge\Modules\Shortcodes\PreviewSlider\PreviewSlider;
use FairEdge\Modules\Shortcodes\PricingTables\PricingTables;
use FairEdge\Modules\Shortcodes\PricingTable\PricingTable;
use FairEdge\Modules\Shortcodes\Process\ProcessHolder;
use FairEdge\Modules\Shortcodes\Process\ProcessItem;
use FairEdge\Modules\Shortcodes\ProgressBar\ProgressBar;
use FairEdge\Modules\Shortcodes\SectionSubtitle\SectionSubtitle;
use FairEdge\Modules\Shortcodes\Separator\Separator;
use FairEdge\Modules\Shortcodes\SocialShare\SocialShare;
use FairEdge\Modules\Shortcodes\Tabs\Tabs;
use FairEdge\Modules\Shortcodes\Tab\Tab;
use FairEdge\Modules\Shortcodes\Team\Team;
use FairEdge\Modules\Shortcodes\UnorderedList\UnorderedList;
use FairEdge\Modules\Shortcodes\VerticalSplitSlider\VerticalSplitSlider;
use FairEdge\Modules\Shortcodes\VerticalSplitSliderContentItem\VerticalSplitSliderContentItem;
use FairEdge\Modules\Shortcodes\VerticalSplitSliderLeftPanel\VerticalSplitSliderLeftPanel;
use FairEdge\Modules\Shortcodes\VerticalSplitSliderRightPanel\VerticalSplitSliderRightPanel;
use FairEdge\Modules\Shortcodes\VideoButton\VideoButton;
use FairEdge\Modules\Shortcodes\ShopMasonry\ShopMasonry;
use FairEdge\Modules\Shortcodes\SectionTitle\SectionTitle;
use FairEdge\Modules\Shortcodes\ItemShowcase\ItemShowcase;
use FairEdge\Modules\Shortcodes\ItemShowcaseListItem\ItemShowcaseListItem;
use FairEdge\Modules\Shortcodes\AnimationHolder\AnimationHolder;
use FairEdge\Modules\Shortcodes\ComboSlider\ComboSlider;
use FairEdge\Modules\Shortcodes\ComboSlideItem\ComboSlideItem;
use FairEdge\Modules\Shortcodes\Banner\Banner;
use FairEdge\Modules\Shortcodes\NumberedBoxes\NumberedBoxes;
use FairEdge\Modules\Shortcodes\NumberedBox\NumberedBox;
use FairEdge\Modules\Shortcodes\CascadingImages\CascadingImages;
use FairEdge\Modules\Shortcodes\VerticalMarquee\VerticalMarquee;
use FairEdge\Modules\Shortcodes\VerticalMarqueeItem\VerticalMarqueeItem;

/**
 * Class ShortcodeLoader
 */
class ShortcodeLoader {
	/**
	 * @var private instance of current class
	 */
	private static $instance;
	/**
	 * @var array
	 */
	private $loadedShortcodes = array();

	/**
	 * Private constuct because of Singletone
	 */
	private function __construct() {}

	/**
	 * Private sleep because of Singletone
	 */
	private function __wakeup() {}

	/**
	 * Private clone because of Singletone
	 */
	private function __clone() {}

	/**
	 * Returns current instance of class
	 * @return ShortcodeLoader
	 */
	public static function getInstance() {
		if(self::$instance == null) {
			return new self;
		}

		return self::$instance;
	}

	/**
	 * Adds new shortcode. Object that it takes must implement ShortcodeInterface
	 * @param ShortcodeInterface $shortcode
	 */
	private function addShortcode(ShortcodeInterface $shortcode) {
		if(!array_key_exists($shortcode->getBase(), $this->loadedShortcodes)) {
			$this->loadedShortcodes[$shortcode->getBase()] = $shortcode;
		}
	}

	/**
	 * Adds all shortcodes.
	 *
	 * @see ShortcodeLoader::addShortcode()
	 */
	private function addShortcodes() {
		$this->addShortcode(new Accordion());
		$this->addShortcode(new AccordionTab());
		$this->addShortcode(new AnimationHolder());
		$this->addShortcode(new Banner());
		$this->addShortcode(new Blockquote());
		$this->addShortcode(new BlogList());
		$this->addShortcode(new BlogSlider());
		$this->addShortcode(new Button());
		$this->addShortcode(new CallToAction());
		$this->addShortcode(new Clients());
		$this->addShortcode(new Client());
		$this->addShortcode(new ComboSlider());
		$this->addShortcode(new ComboSlideItem());
		$this->addShortcode(new Counter());
		$this->addShortcode(new Countdown());
		$this->addShortcode(new CustomFont());
		$this->addShortcode(new DevicePresentation());
		$this->addShortcode(new Dropcaps());
		$this->addShortcode(new ElementsHolder());
		$this->addShortcode(new ElementsHolderItem());
		$this->addShortcode(new GoogleMap());
		$this->addShortcode(new Highlight());
		$this->addShortcode(new Icon());
		$this->addShortcode(new IconListItem());
		$this->addShortcode(new IconWithText());
		$this->addShortcode(new ImageGallery());
		$this->addShortcode(new ItemShowcase());
		$this->addShortcode(new ItemShowcaseListItem());
		$this->addShortcode(new Message());
		$this->addShortcode(new NumberedBoxes());
		$this->addShortcode(new NumberedBox());
		$this->addShortcode(new OrderedList());
		$this->addShortcode(new PieChartBasic());
		$this->addShortcode(new PieChartPie());
		$this->addShortcode(new PieChartDoughnut());
		$this->addShortcode(new PieChartWithIcon());
		$this->addShortcode(new PricingTables());
		$this->addShortcode(new PricingTable());
		$this->addShortcode(new ProgressBar());
		$this->addShortcode(new ProcessHolder());
		$this->addShortcode(new ProcessItem());
		$this->addShortcode(new PreviewSlider());
		$this->addShortcode(new PreviewSlide());
		$this->addShortcode(new SectionSubtitle());
		$this->addShortcode(new Separator());
		$this->addShortcode(new SectionTitle());
		$this->addShortcode(new ShopMasonry());
		$this->addShortcode(new SocialShare());
		$this->addShortcode(new Tabs());
		$this->addShortcode(new Tab());
		$this->addShortcode(new Team());
		$this->addShortcode(new UnorderedList());
		$this->addShortcode(new VerticalSplitSlider());
		$this->addShortcode(new VerticalSplitSliderLeftPanel());
		$this->addShortcode(new VerticalSplitSliderRightPanel());
		$this->addShortcode(new VerticalSplitSliderContentItem());
		$this->addShortcode(new VideoButton());
		$this->addShortcode(new CascadingImages());
		$this->addShortcode(new VerticalMarquee());
		$this->addShortcode(new VerticalMarqueeItem());

	}
	/**
	 * Calls ShortcodeLoader::addShortcodes and than loops through added shortcodes and calls render method
	 * of each shortcode object
	 */
	public function load() {
		$this->addShortcodes();

		foreach ($this->loadedShortcodes as $shortcode) {
			add_shortcode($shortcode->getBase(), array($shortcode, 'render'));
		}
	}
}

$shortcodeLoader = ShortcodeLoader::getInstance();
$shortcodeLoader->load();