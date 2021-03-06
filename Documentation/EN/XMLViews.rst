==================
Building XML Views
==================

We will use a file with **XML** structure and with the name of the
controller that defines it to establish the visual composition of the
fields and options of the view.

The root element of the XML file will be_<view>\_ and the following
groups may be included:

-  **<columns>**: (required) To define the list of fields that are
   displayed in the view.
-  **<rows>**: (optional) Defines special conditions for the rows.
-  **<filters>**: (optional) To define the list of available filters in
   the view.

COLUMNS
=======

You can define by means of the tag *<column>* each one of the fields
that will be visualized in the view being able, in the *Edit* views, to
group the columns by *<group>* tag. The columns are complemented by
the mandatory *<widget>* tag, which serves to customize the type of
object used in the display / editing of the data.

Both *<group>*, *<column>* and *<widget>* tags have a set of
attributes that allow customization and vary according to the context in
which they are executed, ie if it is a *List* view or an *Edit* view. It
is possible to indicate the number of columns that will
occupy *<column>* and/or the group *<group>* within the bootstrap grid
(by default the maximum available).

Example view for ListController:

.. code:: xml

        <columns>
            <column name="code" display="left" order="100">
                <widget type="text" fieldname="codigo" onclick="EditMyModel" />
            </column>
            <column name="description" display="left" order="105">
                <widget type="text" fieldname="descripcion" />
            </column>
            <column name="state" display="center" order="110">
                <widget type="text" fieldname="estado">
                    <option color="red" font-weight="bold">ABIERTO</option>
                    <option color="blue">CERRADO</option>
                </widget>
            </column>
        </columns>

        <rows>
            <row type="status" fieldname="estado">
                <option color="info">Pending</option>
                <option color="warning">Partial</option>
            </row>
        </rows>

EditController view example:

.. code:: xml

        <columns>
            <group name="data" numcolumns="8" title="Identificación internacional" icon="fa-globe">
                <column name="code" display="left" numcolumns="4" order="100">
                    <widget type="text" fieldname="codigo" onclick="EditMyModel" />
                </column>
                <column name="description" display="left" numcolumns="8" order="105">
                    <widget type="text" fieldname="descripcion" />
                </column>
            </group>
            <group name="state" numcolumns="4">
                <column name="state" display="center" order="100">
                    <widget type="text" fieldname="estado">
                        <option color="red" font-weight="bold">ABIERTO</option>
                        <option color="blue">CERRADO</option>
                    </widget>
                </column>
            </group>
        </columns>

column
------

We understand that it is each of the fields of the model that make up
the view and with which the user can interact.

-  **name**: Internal identifier of the column. Its use is obligatory.
   As a rule, the use of lowercase and English identifiers is
   recommended.

-  **title**: Descriptive label of the field, in case of not being
   informed, the value of name is assumed.

-  **titleurl**: Destination URL if the user clicks on the title of the
   column.

-  **description**: Long description of the field that helps the user
   understand. In the List view it is shown as a hint on the column
   title. In Edit view it is displayed as a label inferior to the edit
   area of ​​the field.

-  **display**: Indicates whether or not to display the field and its
   alignment. If not reported, it takes *left* as its value. Values:
   **[*left|center|right|none*]**

-  **order**: Position that occupies the column. Indicates the order in
   which they are displayed. If not reported take the value *100* When
   no specific ordering is reported, it is sorted by the sequential
   position in the XML file, always within its group.

-  **numcolumns**: Force the size of the column to the indicated value,
   using the Bootstrap grid system being minimum 1 and maximum 12. If it
   is not reported, it takes *0* by applying Bootstrap’s automatic size
   system.

widget
------

Visual complement that is used for the visualization and/or edition of
the field/column. In List views, you can complete the *style* html
clause that will be applied to the column by a list of *<option>*,
where each attribute of the label *<option>* corresponds to its CSS
equivalent to be applied and the value of the tag is the value when the
format will be applied. To decide whether the format is applied or not
the following criteria will be applied to the value entered in the *<option>* tag:

-  If the value starts with ‘>’ (>): Applies if the value of the model
   field is greater than the value indicated after the operator.
-  If the value starts with ‘<’ (<): Applies if the field value of the
   model is less than the value indicated after the operator.
-  In any other case an equality check will be made.

Examples:

*Paint red when the field value ``pendiente`` is zero*

.. code:: xml

        <widget type="checkbox" fieldname="pendiente">
            <option color="red">0</option>
        </widget>

*Paint red and bold when the value of field ``estado`` is ``ABIERTO``*
*Paint blue when the value of field ``estado`` is ``CERRADO``*

.. code:: xml

        <widget type="text" fieldname="estado">
            <option color="red" font-weight="bold">ABIERTO</option>
            <option color="blue">CERRADO</option>
        </widget>

*Paint red when the field value ``cantidad`` is less than zero*

.. code:: xml

        <widget type="number" fieldname="cantidad">
            <option color="red">&lt;0</option>
        </widget>

*Paint red when the value of the field ``importe`` is greater than 30000*

.. code:: xml

        <widget type="money" fieldname="importe">
            <option color="red">&gt;30000</option>
        </widget>

-  **type**: (mandatory) Indicates the type of widget to use.
   -  **text**: varchar or text fields.     
   -  **number**: Numeric type fields. For this type you can specify
   the *decimal* attribute to configure the precision to be displayed.
   The *step* attribute to indicate the increase or decrease when performing
   a “step” by the forward/reverse control. The attributes *min* and *max*
   to indicate the minimum and maximum values.
   -  **money**: Fields of type float for amounts.
   For this type you can specify the *decimal* attribute to set the precision to
   be displayed instead of the currency.
   -  **checkbox**: Boolean values ​​that are displayed by
   the icon of a check (true) or a dash (false) respectively.

   -  **datepicker**: Date type fields, which include a drop-down to
      choose it.
   -  **color**: For color selections.
   -  **select**: List of values ​​set by a set of tags *<values>* described
   within the group *<widget>*. The values ​​can be fixed, including as many
   *<values>* as we need and indicating the attribute *title* and assigning a
   value, as dynamic, either calculated based on the contents of the records of
   a table in the database or by defining a range.
   For the case of values ​​of a table will be used a single tag *<values>* indicating
   the attributes:
      -  **source***: Indicates the name of the source table of the data
      -  **fieldcode**: Indicates the field containing the value to be recorded in the column field
      -  **fieldtitle**: Indicates the field containing the value that will be displayed on the screen

   For the case of values ​​by definition of range a single tag *<values>* indicating the attributes:
      -  *start*: Indicates the initial value (numeric or alphabetical)
      -  *end*: Indicates the final value (numeric or alphabetical)
      -  *step*: Indicates the increment value (numeric)

.. code:: xml

    <widget type="select" fieldname="documentacion">
        <values title="Pasaporte">PASAPORTE</values>
        <values title="D.N.I.">DNI</values>
        <values title="N.I.E.">NIE</values>
    </widget>

    <widget type="select" fieldname="codgrupo">
        <values source="gruposclientes" fieldcode="codgrupo" fieldtitle="nombre"></values>
    </widget>

    <widget type="select" fieldname="codgrupo">
        <values start="0" end="6" step="1"></values>
    </widget>


    -  **radio**: List of values ​​where we can select one of them. The various
   options are indicated by the tag system *<values>* described in the group *<widget>*,
   in the style of the *select* type.

   .. code:: xml

           <widget type="radio" fieldname="regimeniva">
               <values title="general">General</values>
               <values title="exempt">Exento</values>
           </widget>

-  **fieldname**: (required) Name of the field containing the
   information.

-  **onclick**: (optional) Name of the controller to call and pass the
   value of the field when clicking on the value of the column.

-  **required**: Optional attribute to indicate that the column must
   have a value at the time the data persist in the database.
   **[required = “true”]**

-  **readonly**: Optional attribute to indicate that the column is not
   editable. **[readonly = “true”]**

-  **icon**: (optional) If indicated, the icon will be displayed to the
   left of the field.

-  **hint**: (optional) Explanatory text that is displayed by placing
   the mouse over the title in the Edit controller.

group
-----

Create a bootstrap grid where it will include each of the *<column>*
columns declared within the group. You can customize the group through
the following attributes:

-  **name**: Internal group identifier. Its use is obligatory. As a
   rule, the use of lowercase and English identifiers is recommended.

-  **title**: Group descriptive label. For groups the name value
   **will not be used** if a title is not entered.

-  **titleurl**: Destination URL if the user clicks on the group title.

-  **icon**: If indicated the icon will be displayed to the left of the
   title. The icon group only will be showed if title is present.

-  **order**: Position of the group. It is used to indicate the order in
   which it will be displayed.

-  **numcolumns**: Force the size to the indicated value, using the
   Bootstrap grid system being minimum 1 and maximum 12. If it is not
   reported, it takes *0* by applying Bootstrap’s automatic size system.
   It is important to remember that a group always has 12 columns
   available in its *interior*, regardless of the size defined by the
   group.

ROWS
====

This group allows you to add functionality to each of the rows or add
rows with special processes. Thus by the label *<row>* we can add the
functionalities, in a unique way (that is, we can not include twice the
same type of row) and using the *type* attribute to indicate the action
performed, each type having its own requirements.

-  **status**: Colorize rows based on the value of a field in the
   record. Requires one or more registers *<option>* indicating the
   bootstrap configuration for panels that we want for the row.

Example:

*paints the row with “info” color if field ``estado`` is ``Pendiente``*
*paints the row with “warning” color if field ``estado`` is ``Parcial``*

.. code:: xml

        <rows>
            <row type="status" fieldname="estado">
                <option color="info">Pending</option>
                <option color="warning">Partial</option>
            </row>
        </rows>

-  **<header>**: Defines a list of statistical and relational buttons
   with other models that give information to the user and allows
   consult when you click.

Example:

.. code:: xml

        <rows>
            <row type="header">
                <option icon="fa-files-o" label="Pending delivery notes:" calculateby="function_name" onclick="#url"></option>
                <option icon="fa-files-o" label="Pending collection:" calculateby="function_name" onclick="#url"></option>
            </row>
        </rows>

-  **<footer>**: Allows you to add additional information to be
   displayed to the user at the foot of the view.

Example:

.. code:: xml

        <rows>
            <row type="footer">
                <option>This is an example with only text</option>
                <option label="Panel Footer" footer="Panel footer" color="warning">This is an example with header and footer</option>
                <option label="This is info" color="info">This is an example with header and without footer</option>
                <option footer="Text in footer" color="success">This is an example without header</option>
            </row>
        </rows>
