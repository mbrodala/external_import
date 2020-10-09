<?php
namespace Cobweb\ExternalImport\Step;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use Cobweb\ExternalImport\Domain\Model\Configuration;
use Cobweb\ExternalImport\Domain\Model\Data;
use Cobweb\ExternalImport\Importer;

/**
 * Abstract class from which all External Import process steps **must** inherit.
 *
 * @package Cobweb\ExternalImport\Step
 */
abstract class AbstractStep
{
    /**
     * @var Data Object encapsulating the data being imported/processed
     */
    protected $data;

    /**
     * @var Configuration Current External Import configuration
     * @deprecated don't call directly, use $this->importer->getExternalConfiguration() instead
     */
    protected $configuration;

    /**
     * @var bool The import process is aborted if this flag is set to true during the current step
     */
    protected $abortFlag = false;

    /**
     * @var Importer Back-reference to the Importer
     */
    protected $importer;

    /**
     * Performs the actual tasks of the step.
     *
     * @return void
     */
    abstract public function run(): void;

    /**
     * Sets the preview data for the Importer class.
     *
     * @param mixed $data
     * @return void
     */
    public function setPreviewData($data): void
    {
        if ($this->importer->isPreview()) {
            $this->importer->setPreviewData($data);
        }
    }

    /**
     * @return Data
     */
    public function getData(): Data
    {
        return $this->data;
    }

    /**
     * @param Data $data
     */
    public function setData(Data $data): void
    {
        $this->data = $data;
    }

    /**
     * @return Configuration
     * @deprecated use $this->importer->getExternalConfiguration() instead
     */
    public function getConfiguration(): Configuration
    {
        trigger_error(
            'Using \Cobweb\ExternalImport\Step\AbstractStep::getConfiguration is deprecated. Use \Cobweb\ExternalImport\Importer::getExternalConfiguration() instead.',
            E_USER_DEPRECATED
        );
        return $this->configuration;
    }

    /**
     * @param Configuration $configuration
     * @deprecated this was used mostly during testing, do not use anymore
     */
    public function setConfiguration(Configuration $configuration): void
    {
        trigger_error(
            'Using \Cobweb\ExternalImport\Step\AbstractStep::setConfiguration is deprecated without replacement. Do not use anymore.',
            E_USER_DEPRECATED
        );
        $this->configuration = $configuration;
    }

    /**
     * @return bool
     */
    public function isAbortFlag(): bool
    {
        return $this->abortFlag;
    }

    /**
     * @param bool $abortFlag
     */
    public function setAbortFlag($abortFlag): void
    {
        $this->abortFlag = $abortFlag;
    }

    /**
     * @return Importer
     */
    public function getImporter(): Importer
    {
        return $this->importer;
    }

    /**
     * @param Importer $importer
     */
    public function setImporter(Importer $importer): void
    {
        $this->importer = $importer;
    }
}