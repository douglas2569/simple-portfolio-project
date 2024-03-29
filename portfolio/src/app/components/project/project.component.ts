import { Component, OnInit, Input } from '@angular/core';
import technology from '../../models/Technology';

@Component({
  selector: 'app-project',
  templateUrl: './project.component.html',
  styleUrls: ['./project.component.css']
})

export class ProjectComponent implements OnInit {
  @Input()
  id!:string
  @Input()
  thumbnail!:string
  @Input()
  name!:string
  @Input()
  technologies!:Array<technology>

  constructor() { }

  ngOnInit(): void {

  }



}
