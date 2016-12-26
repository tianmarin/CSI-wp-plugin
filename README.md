# Continuos Improvement - Wordpress Plugin
This Wordpress Plugin is a personal effort to automate and showcase business information.

## Table of Contents
1. [Features](#features)
2. [Modules](#modules)
  1. [System Landscape](#system-landscape)
  2. [Correction or Mantenance Plan](#cmp-correction-and-maintenance-plan)
  3. [EWA & Actions Dashboard](#ewa--actions-dashboard]
  4. [Change Calendar](#change-calendar)
  5. [BP Calendar](#bp-calendar)


## Features
* Multisite (network) activation
* Shortcodes
* Page Templates fully integrated and customer-url-related
* Google Analytics full integration
* Wordpress TinyMCE integration

## Modules
### System Landscape
#### Features

* Automated extraction of information from SAP Solution Manager LMDB
* Version History
* System & Instance Diagrams

#### Page Templates

* Restart System
* System Diagram
* Customer Landscape

#### Options
#### Shortcodes
##### [Shortcode 1] System Diagram
[Shortcode 1] Display a single system Diagram:
**Input**:

* System ID (default: none)
* Group Similar Instances (default: false)
* Hosts information :hostname, OS, IP
* Instance information: type, technical name

##### [Shortcode 2] Customer Versions
[Shortcode 2] Display Bar|Pie graphs of products and versions
**Inputs**:

* Grahp Type (default: pie)
* Customer (default: current intranet customer)
* Landscape (default: all)
* Asset (default: all)

##### [Shortcode 3] Customer Landscape
[Shortcode 3] Display a group list of systems of a landscape
**Inputs**:

* Customer (default: current intranet customer)
* Landscape (default: all)
* System Exclude (default: none)

##### [Shortcode 4] Customer Landscape
[Shortcode 4] Display a group list of landscape of a customer
**Inputs**:

* Customer (default: current intranet customer)
* Landscape Exclude (default: none)

##### [Shortcode 5] System Restart
[Shortcode 5] Display a guided procedure to stop & start a System
**Inputs**:

* System (default: none)
* System Type (default: abap)
* System SO (default: linux)
* Script version (default: 1)
* Post-restart-url (default: none)

### CMP (Correction or Maintenance Plan)
#### Page Templates
* CMP Editor
* CMP Calendar

#### Features
Graphs of percentage
History of Activity
Wordpress users asignation and measurement
### Options

#### Shortcodes
##### [Shortcode 1] Customer Plans
[Shortcode 1] Display a group list of plans related to a customer
**Inputs**:

* Customer (default: current intranet customer)
* Plan Template url ( default: none)

##### [Shortcode 2] Plan Task List
[Shortcode 2] Display a task list related to a Plan
**Inputs**:

* Plan (default: none)
* Order by (default: start_date)
* Size (default: all) ¿navigation?

##### [Shortcode 3] Customer Dashboard
[Shortcode 3] Display a pie chart of executed, ongoing and planned plans
**Inputs**:

* Customer (default: none)
* Timeline (default: quarter)
* Plan Template url ( default: none)

### EWA & Actions Dashboard
Every Week SAP Solution Manager generates the Early Watch for Solution Report. This module *somehow* process this information and presents the users a 
#### Page Templates

* Current Week (All customer and systems results, for a authorized user to change the
* No-Actions Template (for current customer)

#### Features

* Automated extraction of information from SAP Solution Manager Early Watch for Solution Report
* Result history Dashboard
* New Authorization profile to let users edit the related actions

#### Shortcodes
##### [Shortcode 1] System Panel
[Shortcode 1] Display a Single System Panel with EWA alerts and related actions
**Inputs**:

* System ID
* Number of past weeks (default 8)
* Show Graph (default active)
* Plan Template url ( default: none)

##### [Shortcode 2] Landscape Panel
[Shortcode 2] Display a Single Landscape Panel with EWA alerts and related actions
**Inputs**:

* Landscape ID
* Number of past weeks (default 8)
* Show Graph (default active)

##### [Shortcode 3] No-Actions Panel
[Shortcode 3] Display a table with no-related-actions alerts
**Inputs**:

* Customer (default: current intranet customer)
* Landscape ID (default: all)
* System ID (default: all)
* Number of past weeks (default 1)
* Show Graph (default active)

### Change Calendar
#### Features
* ICAL public url
* ICAL privated url (shows more detail, require user and password [¿Oauth?])
* Hash protection and renewal politics

#### Page Templates
* Calendar administration
* Calendar Hash renewal
* Calendar usage stats

#### Options
* Public & Private Security hash complexity
* Public & Private Security hash date expiration
* Public & Private Security hash 

## BP Calendar
* ICAL Publication
* Active Timeline visualization
* Repeat events
* Each Site/customer has its own BP backend editor. From Specific shortcodes you can display all, some, none, but you should only edit and manage calendars from customer site.
### Features
### Options




## Classes
Customer
Landscape




# Third Party Elements
## Bootstrap
## Font-Awesome
## AmCharts
