#
# Table structure for table 'tt_content'
#
CREATE TABLE tt_content (
	imageshape tinyint(4) unsigned DEFAULT '0' NOT NULL,
	gallery_width tinyint(4) unsigned DEFAULT '0' NOT NULL,
	gallery_ratio tinyint(4) unsigned DEFAULT '0' NOT NULL,
	gallery_carousel tinyint(4) unsigned DEFAULT '0' NOT NULL,
	gallery_nowrap tinyint(4) unsigned DEFAULT '0' NOT NULL
);

CREATE TABLE tx_bootstrappackage_tab_item (
	imageshape tinyint(4) unsigned DEFAULT '0' NOT NULL,
	gallery_width tinyint(4) unsigned DEFAULT '0' NOT NULL,
	gallery_ratio tinyint(4) unsigned DEFAULT '0' NOT NULL,
);
