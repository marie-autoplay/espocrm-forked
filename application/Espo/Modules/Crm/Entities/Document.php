<?php
/************************************************************************
 * This file is part of EspoCRM.
 *
 * EspoCRM – Open Source CRM application.
 * Copyright (C) 2014-2024 Yurii Kuznietsov, Taras Machyshyn, Oleksii Avramenko
 * Website: https://www.espocrm.com
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program. If not, see <https://www.gnu.org/licenses/>.
 *
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 *
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "EspoCRM" word.
 ************************************************************************/

namespace Espo\Modules\Crm\Entities;

use Espo\Core\Field\Link;
use Espo\Core\Field\LinkMultiple;
use Espo\Core\ORM\Entity;
use Espo\Entities\Attachment;
use RuntimeException;

class Document extends Entity
{
    public const ENTITY_TYPE = 'Document';

    public const STATUS_ACTIVE = 'Active';
    public const STATUS_DRAFT = 'Draft';

    public function getName(): ?string
    {
        return $this->get('name');
    }

    public function getFileId(): ?string
    {
        return $this->get('fileId');
    }

    public function getFile(): ?Attachment
    {
        $file = $this->relations->getOne('file');

        if ($file && !$file instanceof Attachment) {
            throw new RuntimeException();
        }

        return $file;
    }

    public function getAssignedUser(): ?Link
    {
        /** @var ?Link */
        return $this->getValueObject('assignedUser');
    }

    public function getTeams(): LinkMultiple
    {
        /** @var LinkMultiple */
        return $this->getValueObject('teams');
    }
}
