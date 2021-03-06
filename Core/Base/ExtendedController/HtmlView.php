<?php
/**
 * This file is part of FacturaScripts
 * Copyright (C) 2013-2017  Carlos Garcia Gomez  <carlos@facturascripts.com>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace FacturaScripts\Core\Base\ExtendedController;

use FacturaScripts\Core\Base;
use Symfony\Component\HttpFoundation\Response;

/**
 * View definition for its use in ExtendedControllers
 *
 * @author Carlos García Gómez <carlos@facturascripts.com>
 * @author Artex Trading sa <jcuello@artextrading.com>
 */
class HtmlView extends BaseView
{
    /**
     * Filename
     *
     * @var string
     */
    public $fileName;

    /**
     * Class constructor and initialization
     *
     * @param string $title
     * @param string $modelName
     * @param string $fileName
     */
    public function __construct($title, $modelName, $fileName)
    {
        parent::__construct($title, $modelName);
        $this->fileName = $fileName;
    }

    /**
     * Method to export the view data
     *
     * @param Base\ExportManager $exportManager
     * @param Response $response
     * @param string $action
     *
     * @return null
     */
    public function export(&$exportManager, &$response, $action)
    {
        return null;
    }

    /**
     * Permite desactivar una columna de una tabla.
     *
     * @param string $columnName
     * @param bool $disabled
     */
    public function disableColumn($columnName, $disabled)
    {
        
    }
}
